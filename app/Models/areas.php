<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class areas extends Model
{
    use HasFactory;

    /**
     * Get the teachers for this area.
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'area_id');
    }

    /**
     * Get the courses for this area.
     */
    public function courses()
    {
        return $this->hasMany(course::class, 'area_id');
    }
}
