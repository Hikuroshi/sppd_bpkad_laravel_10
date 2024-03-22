<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class TandaTangan extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['author', 'pegawai'];

    public function getFileTtdEncodedAttribute()
    {
        if ($this->file_ttd && Storage::exists($this->file_ttd)) {
            $fileContents = Storage::get($this->file_ttd);
            return base64_encode($fileContents);
        }
        return 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault();
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id')->withDefault();
    }

    public function jabatan_kedua(): BelongsTo
    {
        return $this->belongsTo(JabatanKedua::class, 'jabatan_kedua_id')->withDefault();
    }

    public function data_perdins(): HasMany
    {
        return $this->hasMany(DataPerdin::class, 'tanda_tangan_id');
    }

    public function data_perdins_pptk(): HasMany
    {
        return $this->hasMany(DataPerdin::class, 'pptk_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['pegawai.nama', 'pegawai.jabatan.nama'],
                'includeTrashed' => true,
                ]
            ];
        }
    }
