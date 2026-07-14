<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCenter extends Model
{
    use HasFactory;

    /**
     * Get the teachers for this training center.
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'training_center_id');
    }

    /**
     * Get the courses for this training center.
     */
    public function courses()
    {
        return $this->hasMany(course::class, 'training_center_id');
    }
}
