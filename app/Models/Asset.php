<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // PASTIKAN 'image_path' ADA DI DALAM SENARAI INI
    protected $fillable = [
        'name', 
        'serial_number', 
        'category', 
        'os_version',
        'accessories', 
        'purchase_date', 
        'description', 
        'image_path',    // <--- INI SANGAT PENTING!
        'status'
    ];

    protected $casts = [
        'accessories' => 'array',
        'purchase_date' => 'date',
    ];
}