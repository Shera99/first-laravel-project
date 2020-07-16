<?php


namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass() {
        return Model::class;
    }

    /**
     * Получаем моедель для редактирования админки
     * @param int $id
     * @return Model
     */
    public function getEdit($id) {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вывода в списке select
     * @return Collection
     */
    public function getForComboBox() {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title'
        ]);

        $result = $this->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Сприсок категория с пагинацией
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null) {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this->startConditions()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            ->paginate($perPage);
        return $result;
    }
}
