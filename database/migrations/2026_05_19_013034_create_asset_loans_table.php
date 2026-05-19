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
            // $table->foreignId('user_id')->constrained(); // Buka komen ini nanti jika sistem Login dah siap
            $table->string('asset_id'); // Menyimpan ID aset yang dipinjam
            $table->string('purpose'); // Tujuan
            $table->string('location'); // Tempat
            $table->date('borrow_date'); // Tarikh Pinjam
            $table->date('return_date'); // Tarikh Pulang
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
