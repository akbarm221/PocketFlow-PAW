<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = "pemasukan";

    protected $fillable = ['jumlah', 'deskripsi', 'tanggal', 'kategori_pemasukan_id', 'user_id'];

    /**
     * Relasi ke model KategoriPemasukan.
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriPemasukan::class, 'kategori_pemasukan_id');
    }

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
