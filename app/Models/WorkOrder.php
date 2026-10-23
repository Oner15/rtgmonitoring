<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number', 'unit_code', 'block', 'title', 'description',
        'priority', 'status', 'teknisi_id', 'teknisi_nama',
        'eta_minutes', 'mttr_minutes', 'part_needed', 'reported_by',
        'started_at', 'completed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function getPriorityLabelAttribute()
    {
        return match($this->priority) {
            'rendah' => 'Rendah',
            'sedang' => 'Sedang',
            'tinggi' => 'Tinggi',
            'kritis' => 'Kritis',
            default => 'Sedang'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'laporan_baru' => 'Laporan Baru',
            'sedang_dikerjakan' => 'Sedang Dikerjakan',
            'menunggu_suku_cadang' => 'Menunggu Suku Cadang',
            'selesai' => 'Selesai',
            default => 'Laporan Baru'
        };
    }
}
