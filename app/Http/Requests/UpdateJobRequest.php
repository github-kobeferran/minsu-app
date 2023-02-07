<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update job');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'title' => 'required',
            'company' => 'required',
            'descript' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
