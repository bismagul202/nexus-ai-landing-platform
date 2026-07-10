<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['title', 'category', 'image', 'project_url', 'sort_order', 'is_active'];
}
