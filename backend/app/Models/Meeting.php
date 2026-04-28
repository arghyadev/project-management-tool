<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['project_id', 'external_meeting_id', 'title', 'started_at', 'ended_at', 'status', 'transcript_url'];
}
