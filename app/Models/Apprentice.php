<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\ApiQueryScopes;

class Apprentice extends Model
{
    use ApiQueryScopes, HasFactory;

    protected $fillable = ['name', 'email', 'cell_number', 'course_id', 'computer_id'];

    protected function apiQueryOptions(): array
    {
        return [
            'included' => ['course', 'computer'],
            'filter' => ['id', 'name', 'email', 'cell_number', 'course_id', 'computer_id'],
            'sort' => ['id', 'name', 'email'],
        ];
    }

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
