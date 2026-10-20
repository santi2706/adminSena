<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\ApiQueryScopes;

class CourseTeacher extends Model
{
    use ApiQueryScopes, HasFactory;

    // La tabla se llama course_teacher (tabla pivote), no course_teachers.
    protected $table = 'course_teacher';

    protected $fillable = ['course_id', 'teacher_id'];

    protected function apiQueryOptions(): array
    {
        return [
            'included' => ['course', 'teacher'],
            'filter' => ['id', 'course_id', 'teacher_id'],
            'sort' => ['id', 'course_id', 'teacher_id'],
        ];
    }

    /**
     * Get the course that this relation belongs to.
     */
    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }

    /**
     * Get the teacher that this relation belongs to.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
