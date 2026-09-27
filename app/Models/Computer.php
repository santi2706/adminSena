<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\ApiQueryScopes;

class Computer extends Model
{
    use ApiQueryScopes, HasFactory;

    protected $fillable = ['number', 'brand'];

    protected function apiQueryOptions(): array
    {
        return [
            'included' => ['apprentices'],
            'filter' => ['id', 'number', 'brand'],
            'sort' => ['id', 'number', 'brand'],
        ];
    }

    /**
     * Get the apprentices for this computer.
     */
    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'computer_id');
    }
}
