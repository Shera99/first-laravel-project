<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;

class BlogPostsRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'desc')
            ->with([
                //можно так
                'category' => function($query) {
                    $query->select(['id', 'title']);
                },
                //и так
                'user:id,name',
            ])
            ->paginate(25);
        return $result;
    }

    public function getEdit($id) {
        return $this->startConditions()->find($id);
    }
}
