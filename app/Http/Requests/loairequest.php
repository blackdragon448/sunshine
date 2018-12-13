<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loairequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'l_ten'=>'require|unique:loai|max:60',
            'l_taoMoi'=>'required',
            'l_capNhat'=>'required',
            'l_trangThai'=>'required',
        ];
    }
    public function messages(){
        return[
            'l_ten.required'=>'ten loai bat buoc nhap',
            'l_ten.unique'=>'ten loai da co trong he thong, vui long kiem tra lai',
            'l_ten.max'=>'ten loai da vuot qua so luong cho phep',
            'l_taoMoi.required'=>'ngay tao moi khong duoc phep rong'
        ];
    }
}
