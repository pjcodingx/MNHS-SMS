<?php

namespace App\Models;

use App\Models\Adviser;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class SectionSubject extends Model
{
       protected $fillable = [
        'section_id',
        'subject_id',
        'adviser_id',
        'schedule_id',
    ];



    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function adviser()
    {
        return $this->belongsTo(Adviser::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
