<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_level_id'];

      public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }
}
