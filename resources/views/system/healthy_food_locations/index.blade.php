@extends('adminlte::page')

@section('title', 'All Locations')

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

<h1 class="float-left">Show All Locations</h1>
    @if (Auth::user()->hasRole('admin'))
        <div class="float-right">
            <a class="btn btn-primary" href="{{url('system/healthy-food-location/create')}}"><i class="fa fa-plus"></i> Create New</a>
        </div>
    @endif
    <div class="clearfix"></div>
    <hr>
@endsection


@section('content')
    @if ($healthy_food_locations->count())
        <div class="row">
            @foreach ($healthy_food_locations as $healthy_food_location)
                <div class="col col-md-6 col-sm-12">
                    <div class="card" style="">
                        <img src="{{ url('storage/healthy_food_locations_images/'.$healthy_food_location->image) }}" class="img-fluid card-img-left" alt="">
                        <div class="card-body">
                            <h5 class="">{{ $healthy_food_location->name }}</h5>
                            <div class="float-left">
                                <span class="badge badge-primary"><i class="fa fa-user"></i> Admin</span>
                                <span class="badge badge-dark"><i class="far fa-clock"></i> {{$healthy_food_location->created_at}}</span>
                            </div>
                            <div class="float-right">
                                <a href="{{ url('system/healthy-food-location/'. $healthy_food_location->id) }}" class="btn btn-sm btn-info">View</a>
                                @role('admin')
                                    <a href="{{ url('system/healthy-food-location/'. $healthy_food_location->id."/edit") }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form class="d-inline" action="{{ url('system/healthy-food-location/'. $healthy_food_location->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">no healthy food location</h4>
          <p>no healthy food location</p>
        </div>
    @endif
@endsection
