<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = "pengeluaran";
    protected $fillable = ['jumlah', 'deskripsi', 'tanggal', 'kategori_pengeluaran_id', 'user_id'];

    /**
     * Relasi ke model KategoriPengeluaran.
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriPengeluaran::class, 'kategori_pengeluaran_id');
    }

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
