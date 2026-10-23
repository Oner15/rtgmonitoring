<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkOrder;
use Carbon\Carbon;

class WorkOrderController extends Controller
{
    public function index()
    {
        $laporan_baru = WorkOrder::where('status', 'laporan_baru')->latest()->get();
        $sedang_dikerjakan = WorkOrder::where('status', 'sedang_dikerjakan')->latest()->get();
        $menunggu_suku_cadang = WorkOrder::where('status', 'menunggu_suku_cadang')->latest()->get();
        $selesai_hari_ini = WorkOrder::where('status', 'selesai')
            ->whereDate('completed_at', today())
            ->latest()->get();

        $total_aktif = WorkOrder::whereIn('status', ['laporan_baru', 'sedang_dikerjakan', 'menunggu_suku_cadang'])->count();
        $butuh_tindakan_cepat = WorkOrder::whereIn('priority', ['tinggi', 'kritis'])
            ->whereIn('status', ['laporan_baru', 'sedang_dikerjakan', 'menunggu_suku_cadang'])
            ->count();
        $rata_mttr_data = WorkOrder::whereNotNull('mttr_minutes')->avg('mttr_minutes');
        $rata_mttr = $rata_mttr_data ? (int) round($rata_mttr_data) : 42;
        $teknisi_on_duty = 14;

        return view('penanganan', compact(
            'laporan_baru', 'sedang_dikerjakan', 'menunggu_suku_cadang', 'selesai_hari_ini',
            'total_aktif', 'butuh_tindakan_cepat', 'rata_mttr', 'teknisi_on_duty'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_code' => 'required|string',
            'block' => 'required|string',
            'title' => 'required|string|max:255',
            'priority' => 'required|in:rendah,sedang,tinggi,kritis',
            'teknisi_nama' => 'nullable|string|max:100',
            'eta_minutes' => 'nullable|integer|min:1',
            'part_needed' => 'nullable|string|max:255',
            'reported_by' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $unitNum = preg_replace('/[^0-9]/', '', $request->unit_code);
        $ticketNum = 'WO-RTG' . str_pad($unitNum, 2, '0', STR_PAD_LEFT) . '-' . date('ym') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        WorkOrder::create([
            'ticket_number' => $ticketNum,
            'unit_code' => $request->unit_code,
            'block' => $request->block,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'laporan_baru',
            'teknisi_nama' => $request->teknisi_nama,
            'eta_minutes' => $request->eta_minutes,
            'part_needed' => $request->part_needed,
            'reported_by' => $request->reported_by,
        ]);

        return redirect('/penanganan')->with('success', 'Work Order berhasil dibuat!');
    }

    public function updateStatus(Request $request, WorkOrder $workOrder)
    {
        $newStatus = $request->status;
        $data = ['status' => $newStatus];

        if ($newStatus === 'sedang_dikerjakan' && !$workOrder->started_at) {
            $data['started_at'] = Carbon::now();
        }
        if ($newStatus === 'selesai') {
            $data['completed_at'] = Carbon::now();
            if ($workOrder->started_at) {
                $data['mttr_minutes'] = (int) $workOrder->started_at->diffInMinutes(Carbon::now());
            }
        }
        if (isset($request->teknisi_nama)) {
            $data['teknisi_nama'] = $request->teknisi_nama;
        }

        $workOrder->update($data);

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui']);
    }

    public function destroy(WorkOrder $workOrder)
    {
        $workOrder->delete();
        return redirect('/penanganan')->with('success', 'Work Order berhasil dihapus!');
    }
}
