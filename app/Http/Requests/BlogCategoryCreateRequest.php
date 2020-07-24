<?php

namespace App\Http\Requests;


class BlogCategoryCreateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|min:5|max:200',
            'slug'          => 'max:200',
            'description'   => 'string|max:500|min:3',
            'parent_id'     => 'required|integer|exists:blog_categories,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Введите заголовок статьи!",
            'description.min' => "Минимальная длина статьи [:min] символов"
        ];
    }
}
