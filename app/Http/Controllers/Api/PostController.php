<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;

class PostController extends ApiController
{
    private $blogPostRepository;
    public function __construct(BlogPost $blogPost)
    {
        $this->model = $blogPost;
        $this->blogPostRepository = app(BlogPostRepository::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogPostCreateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStore(BlogPostCreateRequest $request)
    {
        return $this->store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogPostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, BlogPostUpdateRequest $request)
    {
        $query = $this->blogPostRepository->getEdit($id);

        if(empty($query)) {
            return $this->sendErr();
        }

        $data = $request->validated();

        if ($query->update($data)) {
            return $this->sendResponse(null, 'Updated', 204);
        } else {
            return $this->sendErr();
        }


        //return $this->update($request, $id);
    }
}
