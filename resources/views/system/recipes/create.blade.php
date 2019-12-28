@extends('adminlte::page')

@section('title', 'Create Recipe')

@section('content_header')
    <h1>Create New Recipe</h1>
    <hr>
@endsection

@section('messages')
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
@endsection

@section('content')
    <form action="{{ url("system/recipe") }}" method="POST" enctype="multipart/form-data">
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
          <label for="image">image</label>
          <input type="file" class="form-control-file" name="image" id="image" placeholder="image" aria-describedby="fileHelpId">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
