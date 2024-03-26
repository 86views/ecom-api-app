<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use Psy\Readline\Hoa\FileException;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        if ($validator->fails()) return response()->json($validator->messages());

        $category = new Category;
        $category->name = $request->name;

        if($request->hasFile('image')) {
            $path = 'assets/uploads/category' . $category->image;
            if(File::exists($path)) {
              File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename =  time() . '.' . $ext;
            try {
                $file->move('assets/uploads/category' . $filename);
            }catch(FileException $e) {
                dd($e);
            }

            $category->image = $filename;
            $category->save();
     
        }
        return new CategoryResource($category);
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $request->validated();
        $category = new Category;
        $category->name = $category->name;
     

        if($request->hasFile('image')) {
            $path = 'assets/uploads/category' . $category->image;
            if(File::exists($path)) {
              File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename =  time() . '.' . $ext;
            try {
                $file->move('assets/uploads/category' . $filename);
            }catch(FileException $e) {
                dd($e);
            }

            $category->image = $filename;
            $category->save();
    }
    return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        
        $category->delete();
 
        return response()->noContent();
    }
}
