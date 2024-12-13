<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class broadcastFormModel extends Model
{
    use HasFactory;

    protected $table = 'broadcasts';

    protected $fillable = [
        'bcname',
        'kontak',
        'waktu',
        'message',
        'showButton',
        'buttonText',
        'showButton',
        'buttonUrl',
        'schedule',
        'image',
        'namaButton'
    ];

    protected $casts = [
        'showButton' => 'boolean',
    ];

    public function kontaks()
    {
        return $this->belongsToMany(ListKontak::class, 'grup_kontak_list_kontak', 'broadcasts', 'list_kontak_id');
    }
}
