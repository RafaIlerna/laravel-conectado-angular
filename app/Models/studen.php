<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'mote',
        'nombre',
        'apellidos',
        'date',
        'correo',
        'password'
    ];
}
