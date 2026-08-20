<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = ['category_id', 'title', 'image', 'demo_link', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
