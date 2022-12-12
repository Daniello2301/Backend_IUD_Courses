<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'name',
        'description',
        'duration',
        'value',
        'total_credits'
    ];

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
