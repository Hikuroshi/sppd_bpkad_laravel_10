<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ketentuan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['author'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault();
    }

    public function pegawai(): HasOne
    {
        return $this->hasOne(Pegawai::class, 'ketentuan_id');
    }
}
