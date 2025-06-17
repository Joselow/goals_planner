<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Goal extends Model
{
    // protected $table = 'categories';
    
    protected $fillable = [
        'name', 
        'category_id',
        'user_id',
        'date',
        'dateCompleted',
        'percentage',
    ];
    
    protected $casts = [
        'percentage' => 'float',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class , 'user_id', 'id');
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class, 'goal_id', 'id' );
    }
}
