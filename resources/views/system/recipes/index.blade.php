@extends('adminlte::page')

@section('title', 'All Recipes')

@section('content_header')
    <h1>Show All Recipes</h1>
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
    @if ($recipes->count())
        <table id="myTable" class="display table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ingredients</th>
                    <th>preparing method</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipes as $recipe)
                    <tr>
                        <td>{{$recipe->name}}</td>
                        <td>{{$recipe->ingredients}}</td>
                        <td>{{$recipe->preparing_method}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">no Recipes</h4>
          <p>no Recipes</p>
        </div>
    @endif
@endsection

{{-- @section('css')
@endsection --}}

@section('js')
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection
