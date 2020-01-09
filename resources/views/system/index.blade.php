@extends('adminlte::page')

@section('title', 'DashBoard')

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
    <h1>Dashboard</h1>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $patientsCount }}</h3>
                    <p>Patients</p>
                </div>
                <div class="icon">
                    <i class="fa fa-wheelchair"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $nutritionistCount }}</h3>
                    <p>Nutritionists</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-md"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $adminsCount }}</h3>
                    <p>System Admins</p>
                </div>
                <div class="icon">
                        <i class="fa fa-user-secret"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $recipesCount }}</h3>
                    <p>Recipes</p>
                </div>
                <div class="icon">
                <i class="fa fa-utensils"></i>
                </div>
                <a href=" {{ url('system/recipe') }} " class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $HealthyFoodLocationsCount }}</h3>
                    <p>Healthy Food Locations</p>
                </div>
                <div class="icon">
                <i class="fa fa-map-marker-alt"></i>
                </div>
                <a href=" {{ url('system/healthy-food-location') }} " class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('js')
    <script> console.log('Hi!'); </script>
@endsection
