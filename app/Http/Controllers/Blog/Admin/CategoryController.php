<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     *
     */
    protected $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categoriesPerPage = BlogCategory::paginate(10);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(10);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
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
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title'], '_');
        }
//
//        $item = new BlogCategory($data);
//        $item->save();

        $item = (new BlogCategory())->create($data);

        if($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                    ->with(['success' => 'Successfully saved']);
        } else {
            return back()->withErrors(['msg' => 'Error saving'])
                    ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();

        $item = $categoryRepository->getEdit($id);

        if(empty($item)) {
            abort(404);
        }

        $categoryList = $categoryRepository->getForCombobox();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
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
//        $rules = [
//            'title' => 'required|min:5|max:200',
//            'slug' => 'max:200',
//            'parent_id' => 'required|integer|exists:blog_categories,id',
//            'description' => 'string|max:500|min:3'
//        ];

//        $validatedData = $this->validate($request, $rules);

//        $validatedData = $request->validate($rules);

//        $validator = \Validator::make($request->all(), $rules);
//        $validatedData[] = $validator->passes();
//        $validatedData[] = $validator->validate();
//        $validatedData[] = $validator->valid();
//        $validatedData[] = $validator->failed();
//        $validatedData[] = $validator->errors();
//        $validatedData[] = $validator->fails();

//        dd($validatedData);


        $item = BlogCategory::find($id);
        $data = $request->all();

        if(empty($item)) {
            return back()->withErrors(['msg' => "Record id={$id} doesn't found !"])
                         ->withInput();
        }

        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title'], '_');
        }

        $result = $item->fill($data)->save();

        if($result) {
            return redirect()->route('blog.admin.categories.edit', $item->id)
                             ->with('success', 'Successfully Saved');
        } else {
            return back()->withErrors(['msg' => "Saving Error"])
                         ->withInput();
        }
    }
}
