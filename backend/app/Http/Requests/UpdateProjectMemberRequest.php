<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'allocation_pct' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'billable' => ['sometimes', 'boolean'],
        ];
    }
}
