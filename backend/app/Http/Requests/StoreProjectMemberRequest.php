<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'allocation_pct' => ['required', 'numeric', 'min:0', 'max:100'],
            'billable' => ['required', 'boolean'],
        ];
    }
}
