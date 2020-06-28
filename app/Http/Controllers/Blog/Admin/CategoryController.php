<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;



class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

  public function __construct()
  {
      parent::__construct();

      $this->blogCategoryRepository = app(BlogCategoryRepository::class);
  }

    public function index()
    {

        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index', compact('paginator'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = BlogCategory()::make();
        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view('blog.admin.categories.edit', compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        /**
         * go away to observer
         */

        $item = BlogCategory::create($data);

        if ($item){
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForCombobox();

       return view('blog.admin.categories.edit',
           compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {

        $item = BlogCategory::find($id);
        if (empty($item)){
            return back()
                ->withErrors(['msg' => "Запись с id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        /**
         * go away to observer
         */
//        if(empty($data['slug'])){
//            $data['slug'] = Str::slug($data['title']);
//        }
        /*
        $result = $item
            ->fill($data)
            ->save();
        */

        $result = $item->update($data);

        if ($result){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }
}
