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
            'full_name'             =>      'required|min:5',
            'so_dien_thoai'         =>      'required|digits:10|unique:admins,so_dien_thoai',
            'email'                 =>      'required|email|unique:admins,email',
            'ma_admin'              =>      'required|min:3|unique:admins,ma_admin',
            'password'              =>      'required|min:5|max:30',
            're_password'           =>      'required|same:password',
            'gioi_tinh'             =>      'required|numeric|min:0|max:2',
            'is_master'             =>      'required|boolean',
        ];
    }
}
