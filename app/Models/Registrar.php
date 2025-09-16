<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Registrar extends Model
{
    //

    use HasFactory, Notifiable;

    protected $guard = 'registrar';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}
