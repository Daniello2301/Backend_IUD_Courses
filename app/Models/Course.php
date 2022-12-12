<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'credits',
        'name_teacher',
        'pre_course',
        'time_auto_work',
        'time_direct_work',
        'semester_id'
    ];

    public function semester(){
        return $this->belongsTo(Semester::class);
    }
}
