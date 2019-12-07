@extends('adminlte::page')

@section('title', 'DashBoard')

@section('content_header')
    <h1>Admin Dashboard</h1>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3>150</h3>

                <p>Patients</p>
                </div>
                <div class="icon">
                <i class="fa fa-wheelchair"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                <h3>53</h3>

                <p>Nutritionists</p>
                </div>
                <div class="icon">
                <i class="fa fa-user-md"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>System Admins</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-secret"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- ./col -->
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('js')
    <script> console.log('Hi!'); </script>
@endsection
