@extends('adminlte::page')
@section('title', 'Laravel')

@section('content_header')
    <h1 class="m-0 text-dark">トップ</h1>
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
