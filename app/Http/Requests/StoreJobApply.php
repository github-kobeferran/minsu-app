<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApply extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('apply job');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'name' => 'required',
                'number' => 'required',
                'email' => 'required|email',
                'resume' => 'required|mimes:docx,pdf,doc',
                'user_id' => 'required',
                'job_id' => 'required',
            ];
    }
}
