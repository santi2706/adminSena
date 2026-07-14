<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;

    /**
     * Get the course that the apprentice belongs to.
     */
    public function course()
    {
        return $this->belongsTo(course::class, 'course_id');
    }

    /**
     * Get the computer that the apprentice belongs to.
     */
    public function computer()
    {
        return $this->belongsTo(Computer::class, 'computer_id');
    }
}
