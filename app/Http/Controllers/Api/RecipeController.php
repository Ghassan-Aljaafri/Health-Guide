<?php

namespace App\Http\Controllers\Api;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'recipes' => Recipe::with('nutritionist')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (Auth::user()->hasRole('nutritionist')) {
            request()->validate([
                'name' => 'required|unique:recipes',
                'ingredients' => 'required',
                'preparing_method' => 'required',
                'image' => 'required',
            ]);

            $recipe = new Recipe();
            $recipe->name = request('name');
            $recipe->ingredients = request('ingredients');
            $recipe->preparing_method = request('preparing_method');

            $file = request()->file('image');
            // Generate a file name with extension
            $fileName = 'recipe_image-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $file->storeAs('public/recipes_images', $fileName);
            $recipe->image = $fileName;

            $recipe->nutritionist_id = Auth::id();
            $recipe->save();
            $recipe->nutritionist;
            return response()->json([
                'message' => 'recipe created successfuly',
                'recipe' => $recipe,
            ]);

        } else {
            return response()->json([
                'message' => 'yor don\'t have a permission to create recipe'
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe->nutritionist;
        return response()->json([
            'recipe' => $recipe,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe)
    {
        if (Auth::user()->id == $recipe->nutritionist_id) {
            request()->validate([
                'name' => 'required',
                'ingredients' => 'required',
                'preparing_method' => 'required',
            ]);

            $recipe->name = request('name');
            $recipe->ingredients = request('ingredients');
            $recipe->preparing_method = request('preparing_method');

            if (request()->hasFile('image')) {
                Storage::delete('public/recipes_images/' . $recipe->image);
                $file = request()->file('image');
                // Generate a file name with extension
                $fileName = 'recipe_image_' . time() . '.' . $file->getClientOriginalExtension();
                // Save the file
                $file->storeAs('public/recipes_images', $fileName);
                $recipe->image = $fileName;
            }

            $recipe->save();
            $recipe->nutritionist;
            return response()->json([
                'message' => 'recipe edit successfuly',
                'recipe' => $recipe,
            ]);
        }
        return response()->json([
            'message' => 'you can\'t edit this recipe'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        if (Auth::user()->id == $recipe->nutritionist_id) {
            Storage::delete('public/recipes_images/' . $recipe->image);
            $recipe->delete();
            return response()->json([
                'message' => 'Recipe deleted successfully'
            ]);
        }
        return response()->json([
            'message' => 'you can\'t delete this post'
        ], 403);
    }
}
