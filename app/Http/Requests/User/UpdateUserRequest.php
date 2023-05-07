<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'full_name'             =>      'required|min:5|max:255',
            'email'                 =>      'required|email|unique:users,email,'. $this->id,
            'phone_number'          =>      'required|digits:10|unique:users,phone_number,'. $this->id,
        ];
    }

    public function messages()
    {
        return [
            'required'      =>  ':attribute cannot be left blank',
            'max'           =>  ':attribute too long',
            'min'           =>  ':attribute too short',
            'unique'        =>  ':attribute already exist',
            'digits'        =>  ':attribute must have 10 numbers',
        ];
    }

    public function attributes()
    {
        return [
            'full_name'         =>  'Full name',
            'email'             =>  'Email',
            'phone_number'      =>  'Phone Number',
        ];
    }
}
