<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\ApiQueryScopes;

class course extends Model
{
    use ApiQueryScopes, HasFactory;

    protected $fillable = ['course_number', 'day', 'area_id', 'training_center_id'];

    protected function apiQueryOptions(): array
    {
        return [
            'included' => ['area', 'trainingCenter', 'teachers', 'apprentices'],
            'filter' => ['id', 'course_number', 'day', 'area_id', 'training_center_id'],
            'sort' => ['id', 'course_number', 'day'],
        ];
    }

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
