<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RtgStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_code',
        'block',
        'status',
        'pelapor',
        'pra_ops',
        'pasca_ops',
    ];
}