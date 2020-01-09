<?php

namespace App\Http\Controllers;

use App\HealthyFoodLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HealthyFoodLocationController extends Controller
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
        return view('system.healthy_food_locations.index', [
            'healthy_food_locations' => HealthyFoodLocation::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('system.healthy_food_locations.create');
        }

        return redirect('system/healthy-food-location')->with('error', "yor don't have a permission to create Healthy Food Location");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
            request()->validate([
                'name' => 'required|unique:healthy_food_locations',
                'longitude' => 'required',
                'latitude' => 'required',
                'image' => 'required',
            ]);

            $file = request()->file('image');
            // Generate a file name with extension
            $fileName = 'healthy_food_location-image-' . time() . '.' . $file->getClientOriginalExtension();
            // Save the file
            $file->storeAs('public/healthy_food_locations_images', $fileName);

            $healthy_food_location = new HealthyFoodLocation;

            $healthy_food_location->name = request('name');
            $healthy_food_location->longitude = request('longitude');
            $healthy_food_location->latitude = request('latitude');
            $healthy_food_location->working_time = request('working_time');
            $healthy_food_location->image = $fileName;
            $healthy_food_location->save();

            return redirect('system/healthy-food-location')->with('success', 'location created successfuly');
        }

        return redirect('system/healthy-food-location')->with('error', "yor don't have a permission to create Healthy Food Location");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $healthy_food_location = HealthyFoodLocation::findOrFail($id);
        return view('system.healthy_food_locations.show')->with([
            'healthy_food_location' => $healthy_food_location
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
        if (Auth::user()->hasRole('admin')) {
            $healthy_food_location = HealthyFoodLocation::findOrFail($id);
            return view('system.healthy_food_locations.edit')->with([
                'healthy_food_location' => $healthy_food_location
            ]);
        }

        return redirect('system/healthy-food-location')->with('error', "yor don't have a permission to edit Healthy Food Location");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->hasRole('admin')) {
            request()->validate([
                'name' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
            ]);

            $healthy_food_location = HealthyFoodLocation::findOrFail($id);
            $healthy_food_location->name = request('name');
            $healthy_food_location->longitude = request('longitude');
            $healthy_food_location->latitude = request('latitude');
            $healthy_food_location->working_time = request('working_time');
            if (request()->hasFile('image')) {
                Storage::delete('public/healthy_food_locations_images/' . $healthy_food_location->image);
                $file = request()->file('image');
                // Generate a file name with extension
                $fileName = 'healthy_food_location-image-' . time() . '.' . $file->getClientOriginalExtension();
                // Save the file
                $file->storeAs('public/healthy_food_locations_images', $fileName);
                $healthy_food_location->image = $fileName;
            }
            $healthy_food_location->save();
            return redirect('system/healthy-food-location')->with('success', 'location updated successfuly');
        }

        return redirect('system/healthy-food-location')->with('error', "yor don't have a permission to edit Healthy Food Location");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('admin')) {
            $healthy_food_location = HealthyFoodLocation::findOrFail($id);

            Storage::delete('public/healthy_food_locations_images/' . $healthy_food_location->image);
            $healthy_food_location->delete();
            return redirect('system/healthy-food-location')->with('success', 'healthy food location deleted successfully');
        }
        return redirect('system/healthy-food-location')->with('error', 'yor don\'t have a permission to delete this Food Location');
    }
}
