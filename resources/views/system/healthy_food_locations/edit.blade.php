@extends('adminlte::page')

@section('title', 'Edit healthy food location')

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
    <h1>Edit Place</h1>
    <hr>
@endsection

@section('content')
    <img src="{{ url('storage/healthy_food_locations_images/'.$healthy_food_location->image) }}" class="img-thumbnail img-fluid card-img-top" alt="no image">
    <form class="col" action="{{ url("system/healthy-food-location/".$healthy_food_location->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Place name</label>
            <input type="text" class="form-control" value="{{ $healthy_food_location->name }}" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="working_time">working time</label>
            <input type="text" class="form-control" value="{{ $healthy_food_location->working_time }}" name="working_time" id="working_time">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image" placeholder="Image" aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">place image</small>
        </div>

        <div class="row">
            <div class="form-group col-6">
                <label for="longitude">Place longitude</label>
                <input type="text" class="form-control" value="{{ $healthy_food_location->longitude }}" name="longitude" id="longitude">
            </div>

            <div class="form-group col-6">
                <label for="latitude">Place latitude</label>
                <input type="text" class="form-control" value="{{ $healthy_food_location->latitude }}" name="latitude" id="latitude">
            </div>
        </div>

        <div id="map"></div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
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

            google.maps.event.addListener(map, 'click', function(event) {
                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: {
                        lat: event.latLng.lat(),
                        lng: event.latLng.lng()
                    },
                    map: map
                });

                lat.value = event.latLng.lat();
                lng.value = event.latLng.lng();
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4fQKTJYNALAWAsnAKse4eAGaEbOAswq4&callback=initMap"async defer></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPNwROWQzFCDpXfx4nQlbdFaD7IE5F_lE&callback=initMap"async defer></script> --}}
@endsection
