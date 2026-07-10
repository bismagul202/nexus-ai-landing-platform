<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'designation', 'image', 'linkedin_url', 'sort_order', 'is_active'];
}