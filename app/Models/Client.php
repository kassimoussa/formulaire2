<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory; 

    protected $fillable = [
        'numero',
        'nom',
        'date_naissance',
        'lieu_naissance',
        'domicile',
        'profession',
        'id_piece',
        'type_piece',
        'piece',
        'piece_public_path',
        'piece_storage_path',
        'date_emission',
        'date_expiration',
        'photo',
        'photo_public_path',
        'photo_storage_path', 
    ];
}
