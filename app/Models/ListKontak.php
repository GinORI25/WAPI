<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKontak extends Model
{
    use HasFactory;

    protected $fillable=['nama','no_hp','email','facebook'];

    public function grups()
    {
        return $this->belongsToMany(GrupKontak::class, 'grup_kontak_list_kontak', 'list_kontak_id', 'grup_kontak_id');
    }
}
