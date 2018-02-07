<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            'title_prd' => 'required',
            'content' => 'required',
//            'fileToUpload' => 'required | mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'title_prd.required' => 'Vui lòng nhập tên sản phẩm ',
            'content.required' => 'Vui lòng nhập mô tả sản phẩm ',
//            'fileToUpload.required' => 'Vui lòng chọn hình ảnh đại diện cho sản phẩm',
//            'fileToUpload.mimes' => 'Vui lòng chọn hình lại định dạng file ảnh',
        ];

    }

}

