@extends('adminlte::page')

@section('title', 'Create Recipe')

@section('content_header')
    <h1>Create New Recipe</h1>
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
    <form action="{{ url("system/recipe") }}" method="POST">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
