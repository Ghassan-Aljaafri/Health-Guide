@extends('adminlte::page')

@section('title', 'Show Recipe')

@section('content_header')
@if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Error</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Success</strong> {{session('success')}}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Error</strong> {{session('error')}}
        </div>
    @endif
<h1>Show Recipe</h1>
    <hr>
@endsection

@section('content')
        <div class="row">
            <div class="col col-12">
                    <div class="card">
                        <img src="{{ url('storage/healthy_food_locations_images/'.$healthy_food_location->image) }}" class="img-thumbnail img-fluid card-img-top" alt="" style="">
                        <div class="card-body">
                            <h1 class="display-4">{{ $healthy_food_location->name }}</h1>
                            <hr>
                            <h4 class="">working time</h4>
                            <p>{{$healthy_food_location->working_time}}</p>
                            <hr>
                            <div id="map"></div>
                            <br>
                            <div class="float-left">
                                <span class="badge badge-primary"><i class="fa fa-user"></i> Admin</span>
                                <span class="badge badge-dark"><i class="far fa-clock"></i> {{$healthy_food_location->created_at}}</span>
                            </div>
                            @role('admin')
                                <div class="float-right">
                                    <a href="{{ url('system/healthy-food-location/'. $healthy_food_location->id . "/edit") }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form class="d-inline" action="{{ url('system/healthy-food-location/'. $healthy_food_location->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            @endrole
                        </div>
                    </div>
                </div>
        </div>
@endsection

@section('css')
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
          height: 400px;
      }
    </style>
@endsection

@section('js')
    <script>
        var map;
        function initMap() {
            var lat = document.getElementById('latitude');
            var lng = document.getElementById('longitude');

            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: { lat: {{ $healthy_food_location->latitude }},lng: {{ $healthy_food_location->longitude }} }
            });

            var marker = new google.maps.Marker({
                position: { lat: {{ $healthy_food_location->latitude }},lng: {{ $healthy_food_location->longitude }} },
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlKKCHDkN8JKdZHsB8o2oeQxSI0vQJmzg&callback=initMap"async defer></script>
@endsection
