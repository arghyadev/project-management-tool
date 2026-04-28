<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    protected $fillable = ['project_id', 'owner_id', 'title', 'severity', 'probability', 'status', 'mitigation_plan'];
}
