<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CapnhatTaikhoanAdminRequest extends Request
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
           'name.required' => 'Họ tên không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được trống',
            'phone.numeric' => 'Số điện thoại phải là số',
        ];
    }
}
