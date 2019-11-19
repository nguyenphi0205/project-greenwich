<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ThemspSizeadminRequest extends Request
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
            'ten_san_pham' => 'required|min:3|max:50',
            'mo_ta' => 'required|min:10',
            'don_vi_tinh' => 'required',
            'gia1' => 'required|numeric',
            'gia2' => 'required|numeric',
            'gia3' => 'numeric',
        ];
    }
     public function messages()
    {
        return [
           'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm',
            'ten_san_pham.min' => 'Tên sản phẩm quá ngắn(dưới 3 ký tự)!',
            'ten_san_pham.max' => 'Tên sản phẩm không được quá 50 kí tự',
            'mo_ta.required' => 'Vui lòng nhập mô tả sản phẩm',
            'mo_ta.min' => 'Mô tả sản phẩm ít nhất 10 kí tự',
            'don_vi_tinh.required' => 'Vui lòng nhập đơn vị tính',
            'gia1.required' => 'Vui lòng nhập giá size 1',
            'gia1.numeric' => 'Đơn giá phải là số',
            'gia2.required' => 'Vui lòng nhập giá size 2',
            'gia2.numeric' => 'Đơn giá phải là số',
            'gia3.numeric' => 'Đơn giá phải là số',
        ];
    }
}
