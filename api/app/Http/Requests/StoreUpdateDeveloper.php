<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateDeveloper extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:155'],
            'email' => ['required', 'string', 'email', 'max:155', Rule::unique('developers')->ignore($this->developer)],
            'level_id' => ['bail', 'required', 'exists:levels,id', 'integer'],
            'gender' => ['required', 'string', 'max:1'],
            'birthdate' => ['required', 'date_format:Y-m-d'],
            'hobby' => ['max:255', 'nullable']
        ];
    }
}



