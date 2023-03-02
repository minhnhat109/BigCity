<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'full_name'             =>      'required|min:5|max:255',
            'email'                 =>      'required|email|unique:admins,email',
            'password'              =>      'required|min:5|max:30',
            're_password'           =>      'required|same:password',
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
        ];
    }

    public function attributes()
    {
        return [
            'full_name'         =>  'Full name',
            'email'             =>  'Email',
            'password'          =>  'Password',
            're_password'       =>  'Repeat password',
        ];
    }
}
