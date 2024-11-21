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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key untuk user
            $table->unsignedBigInteger('kategori_pemasukan_id')->nullable();  // Foreign key untuk kategori pemasukan
            $table->decimal('jumlah', 15, 2);  // Jumlah pemasukan
            $table->string('deskripsi');  // Deskripsi pemasukan
            $table->date('tanggal');  // Tanggal pemasukan
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_pemasukan_id')->references('id')->on('kategori_pemasukan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukans');
    }
};
