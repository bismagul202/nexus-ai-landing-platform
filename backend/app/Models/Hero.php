<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['title', 'subtitle', 'cta_text', 'cta_url', 'background_image', 'is_active'];
}