<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60',
            'category_id' => 'required|integer|exists:categories,id',
            'user_id' => 'required|integer|exists:users,id',
            'date' => 'required|date',
            // 'dateCompleted' => 'nullable|date|after_or_equal:date',
            // 'percentage' => 'nullable|numeric|min:0|max:100',
        ];
    }
}
