<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'                =>  'required|exists:admins,id',
            'full_name'         =>  'required|min:5',
            'email'             =>  'required|email|unique:admins,email,' . $this->id,
            'password'          =>  'nullable|min:6|max:30',
            're_password'       =>  'nullable|same:password',
        ];
    }
    public function messages()
    {
        return [
            'required'      =>  ':attribute cannot be left blank',
            'max'           =>  ':attribute too long',
            'min'           =>  ':attribute too short',
            'unique'        =>  ':attribute already exist',
            'same'          =>  ':attribute and the password is not the same',
            'exists'        =>  ':attribute does not exist',
        ];
    }

    public function attributes()
    {
        return [
            'id'                =>  'ID',
            'full_name'         =>  'Full name',
            'email'             =>  'Email',
            'password'          =>  'Password',
            're_password'       =>  'Repeat password',
        ];
    }
}
