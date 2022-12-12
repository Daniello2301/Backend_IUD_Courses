<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';

    protected $fillable = [
        'name',
        'duration',
        'program_id'
    ];


    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }
}
