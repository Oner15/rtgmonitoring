<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RtgStatus;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RtgStatusController extends Controller
{
    // Mengambil data RTG untuk API & Tampilan Web Dashboard
    public function getStatus()
    {
        $rtgs = RtgStatus::all();
        return response()->json([
            'total_rtg'       => $rtgs->count(),
            'total_ready'     => $rtgs->where('status', 'ready')->count(),
            'total_perbaikan' => $rtgs->where('status', 'perbaikan')->count(),
            'data'            => $rtgs
        ]);
    }

    // Fungsi untuk menerima & menyimpan laporan kendala unit RTG dari Form
   public function storeReport(Request $request)
{
    $request->validate([
        'unit_code' => 'required',
        'pelapor'   => 'required|string',
    ]);

    RtgStatus::updateOrCreate(
        ['unit_code' => $request->unit_code],
        [
            'block'     => 'A',
            'status'    => 'perbaikan',
            'pelapor'   => $request->pelapor,
            'pra_ops'   => $request->pra_ops,
            'pasca_ops' => $request->pasca_ops,
        ]
    );

    return redirect()->route('dashboard')->with('success', 'Laporan berhasil dikirim!');
}
    // Fungsi membaca & mengimpor file Excel
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Kosongkan database lama
        RtgStatus::truncate();

        // Mulai baca dari baris ke-2 (mengabaikan header Excel)
        for ($i = 1; $i < count($rows); $i++) {
            if (!empty($rows[$i][0])) {
                RtgStatus::create([
                    'unit_code' => $rows[$i][0], // Kolom A: Unit (misal "RTG 38")
                    'block'     => $rows[$i][1], // Kolom B: Block (misal "A")
                    'status'    => strtolower(trim($rows[$i][2])), // Kolom C: Status ("ready" / "perbaikan")
                ]);
            }
        }

        return response()->json(['message' => 'Data Excel berhasil diperbarui!']);
    }
}