<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial_number')->unique(); // Tidak boleh ada no siri bertindih
            $table->string('category');
            $table->string('os_version')->nullable();
            
            // Simpan array aksesori dalam format JSON
            $table->json('accessories')->nullable(); 
            
            $table->date('purchase_date')->nullable();
            $table->text('description')->nullable();
            
            // Simpan laluan (path) gambar
            $table->string('image_path')->nullable(); 
            
            // Status lalai (default) aset apabila baru didaftarkan
            $table->string('status')->default('tersedia'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};