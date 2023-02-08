<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update announcement');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'descript' => 'required',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
