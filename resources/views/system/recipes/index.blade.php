@extends('adminlte::page')

@section('title', 'All Recipes')

@section('messages')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Errors</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Error:</strong> {{session('error')}}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Success:</strong> {{session('success')}}
        </div>
    @endif
@endsection

@section('content_header')
    <h1 class="float-left">Show All Recipes</h1>
    @if (Auth::user()->hasPermissionTo('publish-recipe'))
        <div class="float-right">
            <a class="btn btn-primary" href="{{url('system/recipe/create')}}"><i class="fa fa-plus"></i> Create New</a>
        </div>
    @endif
    <div class="clearfix"></div>
    <hr>
@endsection


@section('content')
    @if ($recipes->count())
        <div class="row">
            @foreach ($recipes as $recipe)
                <div class="col col-md-6 col-sm-12">
                    <div class="card" style="">
                        <img src="{{ url('storage/recipes-images/'.$recipe->image) }}" class="img-fluid card-img-left" alt="">
                        <div class="card-body">
                            <h5 class="">{{ $recipe->name }}</h5>
                            <div class="float-left">
                                <span class="badge badge-primary"><i class="fa fa-user"></i> {{$recipe->nutritionist->name}}</span>
                                <span class="badge badge-dark"><i class="far fa-clock"></i> {{$recipe->created_at}}</span>
                            </div>
                            <div class="float-right">
                                <a href="{{ url('system/recipe/'. $recipe->id) }}" class="btn btn-sm btn-info">View</a>
                                @role('nutritionist')
                                    @if (Auth::user()->id == $recipe->nutritionist_id)
                                        <a href="{{ url('system/recipe/'. $recipe->id."/edit") }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form class="d-inline" action="{{ url('system/recipe/'. $recipe->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endif
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">no Recipes</h4>
          <p>no Recipes</p>
        </div>
    @endif
@endsection
