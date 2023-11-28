<?php

namespace App\Http\Controllers\Admin;

use App\ApiHelper\ApiCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\AttachFilesTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use GeneralTrait,AttachFilesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Product::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $details=$request->validated();
            if ($request->image)
            {
                $name = $request->name ?? $request->name_ar;
                $file = $request->image;
                $path = 'asset/product';
                $details['image'] = $this->uploade_image($name, $path, $file);
            }
                $product = Product::create($details);
                return $this->ReturnCreate("Product",$product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product=Product::find($id);
            if (!$product){
                return response()->json(['message' => 'Product not found'], 404)->setStatusCode(404);
            }
         $details=$request->validated();
          if ($request->image)
          {
            $this->deleteFile(public_path($product->image));
            $name = $request->name ?? $product->name;
            $file = $request->image;
            $path = 'asset/category';
            $details['image'] = $this->uploade_image($name, $path, $file);
          }
        $product->update($details);
        return $this->ReturnUpdate("Product",$product);

    }



    /**
     * Remove the specified resource from storage.
     */

        public function destroy(string $id)
    {

          $product=  Product::find($id);
          if (!$product){
              return response()->json(['message' => 'Product not found'], 404)->setStatusCode(404);
          }
         $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);
    }

}
