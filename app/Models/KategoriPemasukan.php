<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPemasukan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pemasukan';

    protected $fillable = ['nama', 'user_id'];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Pemasukan.
     */
    public function pemasukan()
    {
        return $this->hasMany(Pemasukan::class, 'kategori_pemasukan_id');
    }
}
