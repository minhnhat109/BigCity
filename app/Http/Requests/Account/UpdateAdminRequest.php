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
            'ma_admin'          =>  'required|min:3|unique:admins,ma_admin,' . $this->id,
            'full_name'         =>  'required|min:5',
            'so_dien_thoai'     =>  'required|digits:10|unique:admins,so_dien_thoai,' . $this->id,
            'email'             =>  'required|email|unique:admins,email,' . $this->id,
            'password'          =>  'nullable|min:6|max:30',
            're_password'       =>  'nullable|same:password',
            'gioi_tinh'         =>  'required|numeric|min:0|max:2',
            'is_master'         =>  'required|boolean',
        ];
    }
}
