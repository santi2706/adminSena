<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\ApiQueryScopes;

class areas extends Model
{
    use ApiQueryScopes, HasFactory;

    protected $fillable = ['name'];

    protected function apiQueryOptions(): array
    {
        return [
            'included' => ['teachers', 'courses'],
            'filter' => ['id', 'name'],
            'sort' => ['id', 'name'],
        ];
    }

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
