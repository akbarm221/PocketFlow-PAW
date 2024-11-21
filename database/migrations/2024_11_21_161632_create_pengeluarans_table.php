<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('kategori_pengeluaran_id')->nullable()->constrained('kategori_pengeluaran')->onDelete('set null'); // Relasi ke tabel kategori_pengeluaran
            $table->decimal('jumlah', 15, 2); // Jumlah pengeluaran
            $table->text('deskripsi')->nullable(); // Deskripsi pengeluaran
            $table->date('tanggal'); // Tanggal pengeluaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluarans');
    }
};
