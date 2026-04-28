<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingArtifact extends Model
{
    protected $fillable = ['meeting_id', 'type', 'content', 'version', 'approved_by', 'approved_at'];
}
