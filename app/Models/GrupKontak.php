<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupKontak extends Model
{
    use HasFactory;

    protected $fillable = ['nama_grup', 'jumlah_kontak'];

    public function kontak()
    {
        return $this->belongsToMany(ListKontak::class, 'grup_kontak_list_kontak', 'grup_kontak_id', 'list_kontak_id');
    }

    public function getJumlahKontakAttribute()
    {
        return $this->kontak()->count();
    }
}
