<?php


namespace App\Http\Requests;


class BlogPostCreateRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|min:5|max:200|unique:blog_posts',
            'slug'          => 'max:200',
            'content_raw'   => 'required|string|min:5|max:10000',
            'category_id'   => 'required|integer|exists:blog_categories,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Введите заголовок статьи!",
            'content_raw.min' => "Минимальная длина статьи [:min] символов"
        ];
    }

    public function attributes()
    {
        return [
            'title' => "Заголовок"
        ];
    }
}
