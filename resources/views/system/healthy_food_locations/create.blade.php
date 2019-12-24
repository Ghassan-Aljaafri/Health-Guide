@extends('adminlte::page')

@section('title', 'Create Recipe')

@section('content_header')
    <h1>Create New Place</h1>
    <hr>
@endsection

@section('content')
<form action="{{ url("system/") }}" method="POST">
        <div class="row">
            <div class="col col-md-6 col-sm-12">
                @csrf
                <div class="form-group">
                <label for="name">Recipe Name</label>
                <input type="text"
                    class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                <label for="ingredients">ingredients</label>
                <input type="text"
                    class="form-control" name="ingredients" id="ingredients" >
                </div>
                <div class="form-group">
                <label for="preparing_method">Preparing Method</label>
                    <textarea type="text" rows="5"
                    class="form-control" name="preparing_method" id="preparing_method"></textarea>
                </div>

                <div class="form-group">
                <label for=""></label>
                <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
                <small id="fileHelpId" class="form-text text-muted">recipe image</small>
                </div>
            </div>
            <div class="col col-md-6 col-sm-12">
                <div id="map"></div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
@endsection

@section('css')
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
          height: 500px;
      }
    </style>
@endsection

@section('js')
    <script>
        var map;
        function initMap() {
            var location = { lat: 32.8949, lng: 13.1812 };

            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: location
            });

            var marker = new google.maps.Marker({
            //     position: location,
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
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4fQKTJYNALAWAsnAKse4eAGaEbOAswq4&callback=initMap"async defer></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPNwROWQzFCDpXfx4nQlbdFaD7IE5F_lE&callback=initMap"async defer></script> --}}
@endsection
