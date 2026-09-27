<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\ApiQueryScopes;

class TrainingCenter extends Model
{
    use ApiQueryScopes, HasFactory;

    protected $fillable = ['name', 'location'];

    protected function apiQueryOptions(): array
    {
        return [
            'included' => ['teachers', 'courses'],
            'filter' => ['id', 'name', 'location'],
            'sort' => ['id', 'name', 'location'],
        ];
    }

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
