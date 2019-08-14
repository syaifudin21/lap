<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'mandat','no_trx','nomor','nama','items','tagihan', 'status'
    ];

    
}
