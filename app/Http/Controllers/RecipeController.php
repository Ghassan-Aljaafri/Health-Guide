<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('system.recipes.index', [
            'recipes' => Auth::user()->writedRecipes
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
            return redirect('system');
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
        request()->validate([
            'name' => 'required|unique:recipes',
            'ingredients' => 'required',
            'preparing_method' => 'required',
        ]);

        $user = Auth::user();
        if ($user->hasRole('nutritionist')) {
            $recipe = new Recipe();
            $recipe->name = request('name');
            $recipe->ingredients = request('ingredients');
            $recipe->preparing_method = request('preparing_method');
            $recipe->nutritionist_id = $user->id;
            $recipe->save();
            return redirect('system/recipe')->with('success', 'recipe created successfuly');
        } else {
            return redirect('system');
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
        return redirect('/system/recipe')->with('error', 'you can\'t edit this post');
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
        request()->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'preparing_method' => 'required',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->name = request('name');
        $recipe->ingredients = request('ingredients');
        $recipe->preparing_method = request('preparing_method');
        $recipe->save();

        return redirect('system/recipe')->with('success', 'recipe edit successfuly');
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
            $recipe->delete();
            return redirect('system/recipe')->with('success', 'recipe deleted successfully');
        }
        return redirect('/system/recipe')->with('error', 'you can\'t delete this post');
    }
}
