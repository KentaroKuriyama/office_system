@extends('adminlte::page')
@section('title', config('app.name') . '| 障害報告完了')

@section('content')
    @csrf
    <div class="container">
        <div class="main container-fluid">
            <div class="row bg-light text-dark py-5">
                <div class="col-md-8 offset-md-2">
                    <h2 class="fs-1 mb-5 text-center fw-bold">障害報告完了画面</h2>
                    <h2 class="text-center text-primary">障害報告が完了しました。</h2>
                    <div class="d-flex justify-content-between">
                        <p><a href="{{ route('home') }}" class="m-5 btn btn-success">トップ画面に戻る</a></p>
                        <p><a href="{{ route('trouble_report.input') }}" class="m-5 btn btn-primary">別の障害を報告する</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@stop

@section('footer')
    ©EBA Inc. 2013-2024
@endsection
