<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCafeRequest extends FormRequest
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
            'name'                    => 'required',
            'locations.*.address'     => 'required',
            'locations.*.city'        => 'required',
            'locations.*.state'       => 'required',
            'locations.*.zip'         => 'required|regex:/\b\d{6}\b/',
            'locations.*brew_methods' => 'sometimes|array',
            'website'                 => 'sometimes|url'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                 => '咖啡店名字不能为空',
            'name.min'                      => '咖啡店名字不能小于2个字符',
            'locations.*.address.required'  => '咖啡店地址不能为空',
            'locations.*.city.required'     => '咖啡店所在城市不能为空',
            'locations.*.state.required'    => '咖啡店所在省份不能为空',
            'locations.*.zip.required'      => '咖啡店邮编不能为空',
            'locations.*.zip.regex'         => '无效的邮政编码',
            'locations.*brew_methods.array' => '无效的冲泡方法',
            'website.url'                   => '无效的咖啡店网址'
        ];
    }
}
