<?php

namespace App\Http\Controllers\Admin;

use App\ApiHelper\ApiCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\AttachFilesTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait,AttachFilesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Category::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $details=$request->validated();
            if ($request->image)
            {
                $name = $request->name ?? $request->name_ar;
                $file = $request->image;
                $path = 'asset/category';
                $details['image'] = $this->uploade_image($name, $path, $file);
            }
                $category = Category::create($details);

        return $this->ReturnCreate("Category",$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
            $category=Category::find($id);
            if (!$category){
                return response()->json(['message' => 'Category not found'], 404)->setStatusCode(404);
            }
         $details=$request->validated();
          if ($request->image)
          {
            $this->deleteFile(public_path($category->image));
            $name = $request->name ?? $category->name;
            $file = $request->image;
            $path = 'asset/category';
            $details['image'] = $this->uploade_image($name, $path, $file);
          }
            $category->update($details);
        return $this->ReturnUpdate("Category",$category);

    }



    /**
     * Remove the specified resource from storage.
     */

        public function destroy(string $id)
    {

          $category=  Category::find($id);
          if (!$category){
              return response()->json(['message' => 'Category not found'], 404)->setStatusCode(404);
          }
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);


    }

}
