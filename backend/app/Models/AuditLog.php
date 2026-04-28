<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['actor_id', 'entity_type', 'entity_id', 'action', 'before', 'after'];

    protected $casts = [
        'before' => 'array',
        'after' => 'array',
    ];
}
