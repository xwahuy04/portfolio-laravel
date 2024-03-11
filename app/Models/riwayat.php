<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat extends Model
{
    use HasFactory;
    protected $table = "riwayat";
    protected $fillable = ['judul', 'tipe', 'tgl_mulai', 'tgl_akhir', 'info1', 'info2', 'info3', 'isi'];

    // membuat format tanggal menjadi format tanggal Indonesia

    // 1. membuat kolom bantuan
    protected $appends = ['tgl_mulai_indo', 'tgl_akhir_indo'];

    // 2. menambahkan fungsi acessor dan menggunakan class carbon
    public function getTglMulaiIndoAttribute()
    {
        return Carbon::parse($this->attributes['tgl_mulai'])->translatedFormat('d F Y');
    }

    public function getTglAkhirIndoAttribute()
    {
        if ($this->attributes['tgl_akhir']) {
            return Carbon::parse($this->attributes['tgl_akhir'])->translatedFormat('d F Y');
        } else {
            return '';
        }
    }
}
