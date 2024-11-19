<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

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
        return $this->hasMany(Pemasukan::class);
    }

    /**
     * Relasi ke model Pengeluaran.
     */
    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
