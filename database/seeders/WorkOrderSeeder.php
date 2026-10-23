<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkOrder;
use Carbon\Carbon;

class WorkOrderSeeder extends Seeder
{
    public function run(): void
    {
        WorkOrder::truncate();

        $today = Carbon::today();
        $now = Carbon::now();

        $workOrders = [
            // === LAPORAN BARU (3) ===
            [
                'ticket_number' => 'WO-RTG05-2610-001',
                'unit_code' => 'RTG 05',
                'block' => 'Blok A',
                'title' => 'Spreader Lock Error',
                'description' => 'Spreader tidak dapat mengunci container. Alarm E-043 muncul berulang kali saat proses lift.',
                'priority' => 'kritis',
                'status' => 'laporan_baru',
                'teknisi_nama' => null,
                'eta_minutes' => 45,
                'part_needed' => null,
                'reported_by' => 'Op. Andi S.',
                'started_at' => null,
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG12-2610-002',
                'unit_code' => 'RTG 12',
                'block' => 'Blok C',
                'title' => 'Alarm Suhu Oli Tinggi',
                'description' => 'Temperatur oli hidrolik melebihi 85°C. Mesin masih bisa jalan tapi produktivitas terbatas.',
                'priority' => 'tinggi',
                'status' => 'laporan_baru',
                'teknisi_nama' => null,
                'eta_minutes' => 60,
                'part_needed' => 'Filter Oli Hidrolik',
                'reported_by' => 'Op. Budi R.',
                'started_at' => null,
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG08-2610-003',
                'unit_code' => 'RTG 08',
                'block' => 'Blok B',
                'title' => 'Perbaikan Radio Komunikasi RTG-TOS',
                'description' => 'Radio komunikasi antara kabin RTG dan sistem TOS mengalami gangguan sinyal intermittent.',
                'priority' => 'sedang',
                'status' => 'laporan_baru',
                'teknisi_nama' => null,
                'eta_minutes' => 90,
                'part_needed' => null,
                'reported_by' => 'Supervisor Hasan',
                'started_at' => null,
                'completed_at' => null,
                'mttr_minutes' => null,
            ],

            // === SEDANG DIKERJAKAN (4) ===
            [
                'ticket_number' => 'WO-RTG03-2610-004',
                'unit_code' => 'RTG 03',
                'block' => 'Blok A',
                'title' => 'Sensor Anti-Collision Intermittent',
                'description' => 'Sensor anti-collision sisi timur sering false alarm, menyebabkan RTG berhenti tiba-tiba.',
                'priority' => 'tinggi',
                'status' => 'sedang_dikerjakan',
                'teknisi_nama' => 'Agus D.',
                'eta_minutes' => 75,
                'part_needed' => null,
                'reported_by' => 'Op. Cecep M.',
                'started_at' => $now->copy()->subHours(2),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG07-2610-005',
                'unit_code' => 'RTG 07',
                'block' => 'Blok D',
                'title' => 'Kalibrasi Motor Hoist Utama',
                'description' => 'Motor hoist utama memerlukan kalibrasi ulang setelah penggantian encoder.',
                'priority' => 'sedang',
                'status' => 'sedang_dikerjakan',
                'teknisi_nama' => 'Fajar H.',
                'eta_minutes' => 120,
                'part_needed' => null,
                'reported_by' => 'Maint. Planner',
                'started_at' => $now->copy()->subHours(1)->subMinutes(30),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG11-2610-006',
                'unit_code' => 'RTG 11',
                'block' => 'Blok E',
                'title' => 'Tekanan Hidrolik Turun Drastis',
                'description' => 'Tekanan sistem hidrolik hoist turun dari 280 bar ke 190 bar. Dicurigai pompa aus.',
                'priority' => 'kritis',
                'status' => 'sedang_dikerjakan',
                'teknisi_nama' => 'M. Rizki',
                'eta_minutes' => 180,
                'part_needed' => 'Pompa Hidrolik P-220',
                'reported_by' => 'Op. Dani W.',
                'started_at' => $now->copy()->subHours(3),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG02-2610-007',
                'unit_code' => 'RTG 02',
                'block' => 'Blok B',
                'title' => 'Reset Sensor Landasan Trolley',
                'description' => 'Sensor posisi landasan trolley perlu di-reset dan dikalibrasi ulang.',
                'priority' => 'rendah',
                'status' => 'sedang_dikerjakan',
                'teknisi_nama' => 'Roni S.',
                'eta_minutes' => 45,
                'part_needed' => null,
                'reported_by' => 'Op. Eka P.',
                'started_at' => $now->copy()->subMinutes(45),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],

            // === MENUNGGU SUKU CADANG (3) ===
            [
                'ticket_number' => 'WO-RTG09-2610-008',
                'unit_code' => 'RTG 09',
                'block' => 'Blok C',
                'title' => 'Bearing Roda Gantry Kiri Aus',
                'description' => 'Bearing roda gantry sisi kiri mengalami keausan parah. Perlu penggantian segera untuk mencegah kerusakan track.',
                'priority' => 'tinggi',
                'status' => 'menunggu_suku_cadang',
                'teknisi_nama' => 'Bambang W.',
                'eta_minutes' => 240,
                'part_needed' => 'Bearing SKF 6320 (x4)',
                'reported_by' => 'Insp. Wahyu',
                'started_at' => $now->copy()->subHours(5),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG14-2610-009',
                'unit_code' => 'RTG 14',
                'block' => 'Blok A',
                'title' => 'Modul Kontrol PLC I/O Rusak',
                'description' => 'Modul I/O PLC slot 4 tidak merespons. Sudah dicoba restart, error persisten.',
                'priority' => 'kritis',
                'status' => 'menunggu_suku_cadang',
                'teknisi_nama' => 'Dedi A.',
                'eta_minutes' => 480,
                'part_needed' => 'PLC I/O Module Siemens S7-300 SM321',
                'reported_by' => 'Op. Fitra L.',
                'started_at' => $now->copy()->subHours(6),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],
            [
                'ticket_number' => 'WO-RTG06-2610-010',
                'unit_code' => 'RTG 06',
                'block' => 'Blok D',
                'title' => 'Penggantian Lampu Floodlight Mast',
                'description' => '3 dari 6 lampu floodlight pada mast RTG mati. Visibilitas operator terganggu pada shift malam.',
                'priority' => 'sedang',
                'status' => 'menunggu_suku_cadang',
                'teknisi_nama' => 'Riani H.',
                'eta_minutes' => 60,
                'part_needed' => 'Lampu LED Floodlight 400W (x3)',
                'reported_by' => 'Supervisor Malam',
                'started_at' => $now->copy()->subHours(4),
                'completed_at' => null,
                'mttr_minutes' => null,
            ],

            // === SELESAI HARI INI (2) ===
            [
                'ticket_number' => 'WO-RTG01-2610-011',
                'unit_code' => 'RTG 01',
                'block' => 'Blok E',
                'title' => 'Penggantian Solenoid Valve Hoist',
                'description' => 'Solenoid valve hoist mengalami kebocoran internal. Diganti dengan unit baru.',
                'priority' => 'tinggi',
                'status' => 'selesai',
                'teknisi_nama' => 'Agus D.',
                'eta_minutes' => 90,
                'part_needed' => 'Solenoid Valve Rexroth 4WE6D',
                'reported_by' => 'Op. Galih S.',
                'started_at' => $today->copy()->setTime(7, 15),
                'completed_at' => $today->copy()->setTime(9, 42),
                'mttr_minutes' => 147,
            ],
            [
                'ticket_number' => 'WO-RTG10-2610-012',
                'unit_code' => 'RTG 10',
                'block' => 'Blok B',
                'title' => 'Penggantian Filter Bahan Bakar',
                'description' => 'Filter bahan bakar tersumbat menyebabkan mesin tidak mau start. Sudah diganti dan mesin normal.',
                'priority' => 'sedang',
                'status' => 'selesai',
                'teknisi_nama' => 'Fajar H.',
                'eta_minutes' => 30,
                'part_needed' => 'Filter BBM Donaldson P551433',
                'reported_by' => 'Op. Hendra K.',
                'started_at' => $today->copy()->setTime(6, 0),
                'completed_at' => $today->copy()->setTime(6, 38),
                'mttr_minutes' => 38,
            ],
        ];

        foreach ($workOrders as $wo) {
            WorkOrder::create($wo);
        }

        echo "✓ WorkOrderSeeder: 12 work orders berhasil dibuat.\n";
    }
}
