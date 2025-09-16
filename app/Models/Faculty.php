<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Faculty extends Model
{
    //
    use HasFactory, Notifiable;

    protected $guard = 'faculty';

    protected $fillable = [
        'email',
        'name',
        'password'
    ];
}
