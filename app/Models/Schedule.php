<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [  'section_id','grade_level_id', 'subject_id', 'days', 'time_start', 'time_end'];

    protected $casts = [
        'days' => 'array',
    ];

    public function gradeLevel() {
        return $this->belongsTo(GradeLevel::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }


}
