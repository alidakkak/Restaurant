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
use App\Models\Table;
use App\Traits\AttachFilesTrait;
use App\Traits\GeneralTrait;
use http\Env\Response;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use GeneralTrait,AttachFilesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Table::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $details=$request->validated();
       $isExist = Table::where('table_num',$request->table_num)->exists();
       if($isExist) {
           return $this->returnError('error','The table number already exists');
       }else{
           if ($request->image)
           {
               $name = $request->name ?? $request->name_ar;
               $file = $request->image;
               $path = 'asset/table';
               $details['image'] = $this->uploade_image($name, $path, $file);
           }
           $table = Table::create($details);
           return $this->ReturnCreate("Table",$table);
       }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table=Table::find($id);
            if (!$table){
                return response()->json(['message' => 'Table not found'], 404)->setStatusCode(404);
            }
         $details=$request->validated();
          if ($request->image)
          {
            $this->deleteFile(public_path($table->image));
            $name = $request->name ?? $table->name;
            $file = $request->image;
            $path = 'asset/table';
            $details['image'] = $this->uploade_image($name, $path, $file);
          }
        $table->update($details);
        return $this->ReturnUpdate("Product",$table);

    }



    /**
     * Remove the specified resource from storage.
     */

        public function destroy(string $id)
    {

        $table=  Table::find($id);
          if (!$table){
              return response()->json(['message' => 'Table not found'], 404)->setStatusCode(404);
          }
        $table->delete();
            return response()->json(['message' => 'Table deleted successfully']);
    }

}
