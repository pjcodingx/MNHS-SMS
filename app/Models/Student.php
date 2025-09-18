<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    //

    use HasFactory, Notifiable;

     public function getAuthIdentifierName()
    {
        return 'lrn';
    }


    protected $fillable = [
    'lrn', 'last_name', 'first_name', 'middle_initial', 'sex', 'section_id', 'email', 'password'
        ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subjects()
    {
        return $this->hasManyThrough(
            \App\Models\Subject::class,
            \App\Models\Schedule::class,
            'section_id',
            'id',
            'section_id',
            'subject_id'
        );
}
}
