<?php


namespace App\Http\Requests;


class BlogPostUpdateRequest extends ApiRequest
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
            'excerpt'       => 'max:500',
            'content_raw'   => 'required|string|min:5|max:10000',
            'category_id'   => 'required|integer|exists:blog_categories,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required'         => 'Пустой заголовок!!!',
            'content_raw.required'   => 'Пустой контент!!!',
            'category_id.required'   => 'Пустая категория!!!'
        ];
    }
}
