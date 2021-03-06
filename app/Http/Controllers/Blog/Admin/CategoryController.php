<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Repositories\BlogCategoryRepository;
use App\Models\BlogCategory;

class CategoryController extends BaseController
{
    private $blocCategoryRepository;
    public function __construct()
    {
        parent::__construct();
        $this->blocCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Получаем данные с пагинацией из репозитория
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function index()
    {
        $paginator = $this->blocCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }


    public function create()
    {
        $item = BlogCategory::make();
        $categoryList = $this->blocCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }


    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        $item = BlogCategory::create($data); // Создаст объект но не добавит в БД
        $item->save();
        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            $msg = 'Ошибка сохранения';
            return back()->withErrors(['msg' => $msg])
                ->withInput();
        }
    }


    public function edit($id, BlogCategoryRepository $blogCategoryRepository)
    {
        $item = $blogCategoryRepository->getEdit($id);

        /*$v['title_before'] = $item->title;

        $item->title = 'Dsdsjd jisdpij 1212';

        $v['title_after'] = $item->title;
        $v['getAtribute'] = $item->getAttribute('title');
        $v['atributesToArray'] = $item->attributesToArray();
        $v['atributes'] = $item->attributes['title'];
        $v['getAtributeValue'] = $item->getAttributeValue('title');
        $v['getMutatedAtribute'] = $item->getMutatedAttributes();
        $v['hasGetMutator for title'] = $item->hasGetMutator('title');
        $v['toArray'] = $item->toArray();

        dd($v, $item);*/

        if(empty($item)) {
            abort(404);
        }
        $categoryList = $blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }


    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /**
         * validate(): Если есть ошибка то back()->withErrors()->withInput
         * passes(): Без редиректа, также выполняется в validate(), возвращает True - если все норм
         * valid(): Возврашает валидные данные
         * failed(): Возврашает не валидные данные
         * errors(): Возврашает ошибки не валидных данных
         * fails(): Возвращает True - если все плохо
         */

        /**
         * $validateData = $request->validate($this->rulesCategory);
         * $validator = \Validator::make($request->all(), $this->rulesCategory);
         * $validateData[] = $validator->validate();
         * $validateData[] = $validator->valid();
         * $validateData[] = $validator->passes();
         * $validateData[] = $validator->failed();
         * $validateData[] = $validator->errors();
         * $validateData[] = $validator->fails();
         * $validateData = $this->validate($request, $this->rulesCategory);
          */

        $item = BlogCategory::find($id);
        if (empty($item)) {
            $msg = "Запись с id - [{$id}] не найдена!!!";
            return back()->withErrors(['msg' => $msg])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);
        //$result = $item->fill($data)->save();

        if ($result) {
            return redirect()->route('blog.admin.categories.edit', $item->id)
                             ->with(['success' => 'Успешно сохранено']);
        } else {
            $msg = 'Ошибка сохранения';
            return back()->withErrors(['msg' => $msg])
                ->withInput();
        }
    }
}
