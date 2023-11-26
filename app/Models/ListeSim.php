<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeSim extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'numero', 
        'nom', 
        'status',
        'groupe'
    ];
}
