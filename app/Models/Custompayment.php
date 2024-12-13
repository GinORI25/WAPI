<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class custompayment extends Model
{
    use HasFactory;
    protected $table = 'cuspayment';
    protected $fillable = ['iduser', 'nama', 'username', 'harga_bayar', 'metode_bayar', 'catatan'];
}
