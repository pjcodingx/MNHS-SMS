<?php

namespace App\Models;

use App\Models\Strand;
use App\Models\GradeLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_level_id','strand_id'];


    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }

     public function strand() {
        return $this->belongsTo(Strand::class, 'strand_id');
    }

     public function schedules()
    {
        return $this->hasMany(Schedule::class, 'section_id');
    }

    public function sectionSubjects()
    {
        return $this->hasMany(SectionSubject::class);
    }
}
