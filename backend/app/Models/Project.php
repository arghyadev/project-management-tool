<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'phase',
        'status',
        'start_date',
        'end_date',
        'budget',
        'created_by',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
