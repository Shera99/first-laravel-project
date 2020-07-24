<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;

class CategoryController extends ApiController
{
    public function __construct(BlogCategory $blogCategory)
    {
        $this->model = $blogCategory;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogCategoryCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function categoryStore(BlogCategoryCreateRequest $request)
    {
        return $this->store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryUpdate(BlogCategoryUpdateRequest $request, int $id)
    {
        return parent::update($request, $id);
    }
}
