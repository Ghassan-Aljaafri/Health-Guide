@extends('adminlte::page')

@section('title', 'Show Recipe')

@section('content_header')
    <h1>Show Recipe</h1>
    <hr>
@endsection

@section('messages')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Errors</h4>
          <p class="mb-0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
          </p>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Success</h4>
          <p class="mb-0">
              {{session('success')}}
          </p>
        </div>
    @endif
@endsection

@section('content')
        <div class="row">
            <div class="col col-12">
                    <div class="card" style="">
                        <img src="{{ url('storage/recipes-images/'.$recipe->image) }}" class="card-img-top" alt="" style="">
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
