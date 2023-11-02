<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'code',
        'status',
        'date_envoie',
    ];
}
