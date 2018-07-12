<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'short-url' => 'required|string|min:5|max:255',
            'till' => 'nullable|integer'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (strpos($this->get('short-url'), config('app.url')) !== 0) {
                $validator->errors()->add('short-url', 'Ссылка должна принадлежать нашему сайту');
            }
        });
    }
}
