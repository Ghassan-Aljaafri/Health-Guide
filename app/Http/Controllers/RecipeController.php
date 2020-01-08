<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('system.recipes.index', [
            'recipes' => Recipe::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->hasRole('nutritionist')) {
            return view('system.recipes.create');
        } else {
            return redirect('system/recipe')->with('error', "yor don't have a permission to create recipe");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            return redirect('system/recipe')->with('success', 'recipe created successfuly');
        } else {
            return redirect('system')->with('error', "yor don't have a permission to create recipe");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('system.recipes.show', [
            'recipe' => $recipe
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        if (Auth::user()->id == $recipe->nutritionist_id) {
            return view('system.recipes.edit', [
                'recipe' => $recipe
            ]);
        }
        return redirect('/system/recipe')->with('error', 'you can\'t edit this recipe');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $recipe = Recipe::findOrFail($id);
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

            return redirect('system/recipe')->with('success', 'recipe edit successfuly');
        }
        return redirect('/system/recipe')->with('error', 'you can\'t edit this post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        if (Auth::user()->id == $recipe->nutritionist_id) {
            Storage::delete('public/recipes_images/' . $recipe->image);
            $recipe->delete();
            return redirect('system/recipe')->with('success', 'recipe deleted successfully');
        }
        return redirect('/system/recipe')->with('error', 'you can\'t delete this post');
    }

    public function indexMine()
    {
        $user = Auth::user();
        if ($user->hasRole('nutritionist')) {
            return view('system.recipes.index', [
                'recipes' => Auth::user()->writedRecipes
            ]);
        }
        // return redirect();
    }
}
