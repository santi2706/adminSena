<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    /**
     * Get the area that the course belongs to.
     */
    public function area()
    {
        return $this->belongsTo(areas::class, 'area_id');
    }

    /**
     * Get the training center that the course belongs to.
     */
    public function trainingCenter()
    {
        return $this->belongsTo(TrainingCenter::class, 'training_center_id');
    }

    /**
     * Get the teachers for this course.
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher', 'course_id', 'teacher_id');
    }

    /**
     * Get the apprentices for this course.
     */
    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'course_id');
    }
}
