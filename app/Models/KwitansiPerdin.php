<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KwitansiPerdin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['author', 'kegiatan_sub', 'pptk'];

    public function terbilang($angka)
    {
        $angka = ltrim($angka, '0');

        $bilangan = [
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        ];

        if (bccomp($angka, '12') == -1) {
            return $bilangan[intval($angka)];
        } elseif (bccomp($angka, '20') == -1) {
            return $this->terbilang(bcsub($angka, '10')) . ' belas';
        } elseif (bccomp($angka, '100') == -1) {
            return $this->terbilang(bcdiv($angka, '10')) . ' puluh ' . $this->terbilang(bcmod($angka, '10'));
        } elseif (bccomp($angka, '200') == -1) {
            return 'seratus ' . $this->terbilang(bcsub($angka, '100'));
        } elseif (bccomp($angka, '1000') == -1) {
            return $this->terbilang(bcdiv($angka, '100')) . ' ratus ' . $this->terbilang(bcmod($angka, '100'));
        } elseif (bccomp($angka, '2000') == -1) {
            return 'seribu ' . $this->terbilang(bcsub($angka, '1000'));
        } elseif (bccomp($angka, '1000000') == -1) {
            return $this->terbilang(bcdiv($angka, '1000')) . ' ribu ' . $this->terbilang(bcmod($angka, '1000'));
        } elseif (bccomp($angka, '1000000000') == -1) {
            return $this->terbilang(bcdiv($angka, '1000000')) . ' juta ' . $this->terbilang(bcmod($angka, '1000000'));
        } elseif (bccomp($angka, '1000000000000') == -1) {
            return $this->terbilang(bcdiv($angka, '1000000000')) . ' miliar ' . $this->terbilang(bcmod($angka, '1000000000'));
        } elseif (bccomp($angka, '1000000000000000') == -1) {
            return $this->terbilang(bcdiv($angka, '1000000000000')) . ' triliun ' . $this->terbilang(bcmod($angka, '1000000000000'));
        } elseif (bccomp($angka, '1000000000000000000') == -1) {
            return $this->terbilang(bcdiv($angka, '1000000000000000')) . ' kuadriliun ' . $this->terbilang(bcmod($angka, '1000000000000000'));
        } elseif (bccomp($angka, '1000000000000000000000') == -1) {
            return $this->terbilang(bcdiv($angka, '1000000000000000000')) . ' kuintiliun ' . $this->terbilang(bcmod($angka, '1000000000000000000'));
        } else {
            return 'Angka terlalu besar';
        }
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault();
    }

    public function kegiatan_sub(): BelongsTo
    {
        return $this->belongsTo(KegiatanSub::class, 'kegiatan_sub_id')->withDefault();
    }

    public function pptk(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pptk_id')->withDefault();
    }

    public function pegawais()
    {
        return $this->belongsToMany(Pegawai::class, 'kwitansi_pegawai', 'kwitansi_perdin_id', 'pegawai_id')
        ->withPivot('uang_harian', 'uang_transport', 'uang_tiket', 'uang_penginapan');
    }

    public function data_perdin(): HasOne
    {
        return $this->hasOne(DataPerdin::class, 'laporan_perdin_id');
    }
}
