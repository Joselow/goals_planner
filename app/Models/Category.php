<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{   
    protected $table = 'categories';
    
    protected $fillable = [
        'name', 
        'color',
        'user_id',
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'percentage',
    ];
    
    public function goals(): HasMany {
        return $this->hasMany(Goal::class, 'category_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class , 'user_id', 'id');
    }
}
