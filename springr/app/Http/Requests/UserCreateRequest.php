<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
       
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255',
            'date_joining' => 'required|date|before:now',
            'date_leaving' => 'nullable|after:date_joining',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'date_joining.required' => 'Joining date is required',
            'date_joining.before' => 'Please choose a date in the Past',
            'date_leaving.after' => 'Leaving date is before joining date'
        ];
    }
    
}
