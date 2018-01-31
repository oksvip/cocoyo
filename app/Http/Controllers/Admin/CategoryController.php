<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\Category as CategoryResource;
use App\Modules\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::latest()->paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:15',
            'path' => 'required',
            'description' => 'required'
        ]);

        Category::create($request->all());

        return $this->noContent();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function edit(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param Request $request
     * @return \Response
     */
    public function update(Category $category, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:15',
            'path' => 'required',
            'description' => 'required'
        ]);

        $category->fill($request->all());

        $category->save();

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}