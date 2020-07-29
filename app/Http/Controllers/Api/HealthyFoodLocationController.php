<?php

namespace App\Http\Controllers\Api;

use App\HealthyFoodLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HealthyFoodLocationController extends Controller
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
            'healthyFoodLocations' => HealthyFoodLocation::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
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

            return response()->json([
                'message' => 'location created successfuly',
                'healthyFoodLocation' => $healthy_food_location,
            ]);
        }
        return response()->json([
            'message' => 'yor don\'t have a permission to create Healthy Food Location'
        ], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HealthyFoodLocation  $healthyFoodLocation
     * @return \Illuminate\Http\Response
     */
    public function show(HealthyFoodLocation $healthyFoodLocation)
    {
        return response()->json([
            'healthyFoodLocation' => $healthyFoodLocation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\HealthyFoodLocation  $healthyFoodLocation
     * @return \Illuminate\Http\Response
     */
    public function update(HealthyFoodLocation $healthyFoodLocation)
    {
        if (Auth::user()->hasRole('admin')) {
            request()->validate([
                'name' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
            ]);
            $healthyFoodLocation->name = request('name');
            $healthyFoodLocation->longitude = request('longitude');
            $healthyFoodLocation->latitude = request('latitude');
            $healthyFoodLocation->working_time = request('working_time');
            if (request()->hasFile('image')) {
                Storage::delete('public/healthy_food_locations_images/' . $healthyFoodLocation->image);
                $file = request()->file('image');
                // Generate a file name with extension
                $fileName = 'healthy_food_location-image-' . time() . '.' . $file->getClientOriginalExtension();
                // Save the file
                $file->storeAs('public/healthy_food_locations_images', $fileName);
                $healthyFoodLocation->image = $fileName;
            }
            $healthyFoodLocation->save();
            return response()->json([
                'message' => 'location edit successfuly',
                'healthyFoodLocation' => $healthyFoodLocation,
            ]);
        }
        return response()->json([
            'message' => 'yor don\'t have a permission to edit Healthy Food Location'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HealthyFoodLocation  $healthyFoodLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthyFoodLocation $healthyFoodLocation)
    {
        if (Auth::user()->hasRole('admin')) {
            Storage::delete('public/healthy_food_locations_images/' . $healthyFoodLocation->image);
            $healthyFoodLocation->delete();
            return response()->json([
                'message' => 'healthy food location deleted successfully'
            ]);
        }
        return response()->json([
            'message' => 'yor don\'t have a permission to delete this Food Location'
        ], 403);
    }
}
