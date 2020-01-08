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
                    <div class="card" style="">
                        <img src="{{ url('storage/recipes_images/'.$recipe->image) }}" class="img-thumbnail img-fluid card-img-top" alt="" style="">
                        <div class="card-body">
                            <h1 class="display-4">{{ $recipe->name }}</h1>
                            <hr>
                            <h4 class="">Ingredients</h4>
                            <p>{{$recipe->ingredients}}</p>
                            <h4 class="">Preparing Method</h4>
                            <p>{{$recipe->preparing_method}}</p>
                            <hr>
                            <div class="float-left">
                                <span class="badge badge-primary"><i class="fa fa-user"></i> {{$recipe->nutritionist->name}}</span>
                                <span class="badge badge-dark"><i class="far fa-clock"></i> {{$recipe->created_at}}</span>
                            </div>

                            @role('nutritionist')
                                @if (Auth::user()->id == $recipe->nutritionist_id)
                                <div class="float-right">
                                    <a href="{{ url('system/recipe/'. $recipe->id . "/edit") }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form class="d-inline" action="{{ url('system/recipe/'. $recipe->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                                @endif
                            @endrole
                        </div>
                    </div>
                </div>
        </div>
@endsection
