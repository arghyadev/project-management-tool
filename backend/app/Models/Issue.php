<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['project_id', 'owner_id', 'title', 'status', 'resolution'];
}
