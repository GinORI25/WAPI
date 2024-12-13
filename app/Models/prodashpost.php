<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodashpost extends Model
{
    use HasFactory;
    protected $fillable = ['nama_project', 'username', 'password', 'no_handphone', 'facebook', 'image'];
}
