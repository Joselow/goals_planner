<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    
    protected $fillable = [
        'name',
        'goal_id',
        'completed',
        'observation',
    ];

    public function goal(): BelongsTo 
    {
        return $this->belongsTo(Goal::class);
    }
}
