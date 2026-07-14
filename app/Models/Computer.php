<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    /**
     * Get the apprentices for this computer.
     */
    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'computer_id');
    }
}
