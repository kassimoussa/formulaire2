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
        'piece_recto',
        'piece_verso',
        'piece_recto_public_path',
        'piece_recto_storage_path',
        'piece_verso_public_path',
        'piece_verso_storage_path',
        'date_emission',
        'date_expiration',
        'photo',
        'photo_public_path',
        'photo_storage_path', 
        'user_id'
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
