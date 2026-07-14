<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * Get the area that the teacher belongs to.
     */
    public function area()
    {
        return $this->belongsTo(areas::class, 'area_id');
    }

    /**
     * Get the training center that the teacher belongs to.
     */
    public function trainingCenter()
    {
        return $this->belongsTo(TrainingCenter::class, 'training_center_id');
    }

    /**
     * Get the courses that the teacher teaches.
     */
    public function courses()
    {
        return $this->belongsToMany(course::class, 'course_teacher', 'teacher_id', 'course_id');
    }
}
