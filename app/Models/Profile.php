<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description', 'email', 'photo'];

    /**
     * Get the singleton profile, or create a blank instance.
     */
    public static function getSingleton(): self
    {
        return self::first() ?? new self();
    }
}
