<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialSnapshot extends Model
{
    protected $fillable = ['project_id', 'crm_ref', 'planned_budget', 'actual_cost', 'revenue', 'captured_at'];
}
