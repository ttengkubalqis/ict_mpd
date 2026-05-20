<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('asset_loans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained(); // Buka bila sistem login siap
            $table->string('purpose'); // Tujuan
            $table->string('location'); // Tempat
            $table->date('borrow_date'); // Tarikh Pinjam
            $table->date('return_date'); // Tarikh Pulang
            
            // PERUBAHAN DI SINI:
            $table->string('asset_type'); // Simpan jenis aset (cth: Laptop)
            $table->integer('quantity')->default(1); // Simpan kuantiti
            $table->string('asset_id')->nullable(); // Dibiarkan KOSONG dahulu. Admin akan isi masa luluskan.
            
            $table->string('status')->default('pending'); // pending, approved, rejected, returned
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_loans');
    }
};
