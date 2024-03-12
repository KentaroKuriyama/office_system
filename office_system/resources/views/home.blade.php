@extends('adminlte::page')
@section('title', '社内システム')

@section('content_header')
    <h1 class="m-0 text-dark">トップ</h1>
@stop

@section('content')
    <div class="info-box">
        <span class="info-box-icon bg-primary"><i class="fa fa-star-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">93,139</span>
        </div>
    </div>
    <div class="info-box bg-info">
        <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">41,410</span>

            <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
                70% Increase in 30 Days
            </span>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop

@section('footer')
    ©EBA Inc. 2013-2024
@endsection
