<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Traits\AttachFilesTrait;
use App\Traits\GeneralTrait;

class IngredientController extends Controller
{
    use GeneralTrait,AttachFilesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Ingredient::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngredientRequest $request)
    {
        $details=$request->validated();
            if ($request->image)
            {
                $name = $request->name;
                $file = $request->image;
                $path = 'asset/ingredient';
                $details['image'] = $this->uploade_image($name, $path, $file);
            }
                $ingredient = Ingredient::create($details);
                return $this->ReturnCreate("ingredient",$ingredient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request, string $id)
    {
        $ingredient=Ingredient::find($id);
            if (!$ingredient){
                return response()->json(['message' => 'Ingredient not found'], 404)->setStatusCode(404);
            }
         $details=$request->validated();
          if ($request->image)
          {
            $this->deleteFile(public_path($ingredient->image));
            $name = $request->name ?? $ingredient->name;
            $file = $request->image;
            $path = 'asset/ingredient';
            $details['image'] = $this->uploade_image($name, $path, $file);
          }
        return $this->ReturnUpdate("ingredient",$ingredient);

    }



    /**
     * Remove the specified resource from storage.
     */

        public function destroy(string $id)
    {

          $ingredient=  Ingredient::find($id);
          if (!$ingredient){
              return response()->json(['message' => 'Ingredient not found'], 404)->setStatusCode(404);
          }
        $ingredient->delete();
            return response()->json(['message' => 'Ingredient deleted successfully']);
    }

}
