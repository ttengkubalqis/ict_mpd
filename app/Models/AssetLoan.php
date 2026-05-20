<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'purpose', 'location', 'borrow_date', 'return_date',
        'asset_type', 'quantity', 'asset_id', 'status', 
        'collection_date', 'collection_time', // <-- Tambah dua baris ini
    ];
}