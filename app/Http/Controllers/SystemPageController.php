<?php

namespace App\Http\Controllers;

use App\HealthyFoodLocation;
use App\Recipe;
use App\User;
use Illuminate\Http\Request;

class SystemPageController extends Controller
{
    public function dashboard() {
        $adminsCount = User::role('admin')->get()->count();
        $nutritionistCount = User::role('nutritionist')->get()->count();
        $patientsCount = User::role('patient')->get()->count();
        $recipesCount = Recipe::all()->count();
        $HealthyFoodLocationsCount = HealthyFoodLocation::all()->count();

        return view('system.index')->with([
            'adminsCount' => $adminsCount,
            'nutritionistCount' => $nutritionistCount,
            'patientsCount' => $patientsCount,
            'recipesCount' => $recipesCount,
            'HealthyFoodLocationsCount' => $HealthyFoodLocationsCount,
        ]);
    }
}
