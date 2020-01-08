@extends('adminlte::page')

@section('title', 'Edit Recipe')

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
    <h1>Edit New Recipe</h1>
    <hr>
@endsection

@section('content')
    <img src="{{ url('storage/recipes_images/'.$recipe->image) }}" class="img-thumbnail img-fluid card-img-top" alt="no image">
    <form action="{{ url("system/recipe/". $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Recipe Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$recipe->name}}">
        </div>
        <div class="form-group">
            <label for="ingredients">ingredients</label>
            <input type="text" class="form-control" name="ingredients" id="ingredients" value="{{$recipe->ingredients}}" >
        </div>
        <div class="form-group">
            <label for="preparing_method">Preparing Method</label>
            <textarea type="text" rows="5"class="form-control" name="preparing_method" id="preparing_method">{{$recipe->preparing_method}}</textarea>
        </div>

        <div class="form-group">
          <label for="image">image</label>
          <input type="file" class="form-control-file" name="image" id="image" placeholder="image" aria-describedby="fileHelpId">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
