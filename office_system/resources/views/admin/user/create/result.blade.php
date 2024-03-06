@extends('adminlte::page')
@section('title', config('app.name') . '| ユーザ登録完了')

@section('content')
    @csrf
    <div class="container">
        <div class="main container-fluid">
            <div class="row bg-light text-dark py-5">
                <div class="col-md-8 offset-md-2">
                    <h2 class="fs-1 mb-5 text-center fw-bold">ユーザ登録完了画面</h2>
                    <h2 class="text-center text-primary">新規ユーザ登録が完了しました。</h2>
                    <div class="d-flex justify-content-between">
                        <p><a href="{{ route('admin.user.index') }}" class="m-5 btn btn-success">一覧画面に戻る</a></p>
                        <p><a href="{{ route('admin.user.create.input') }}" class="m-5 btn btn-primary">別のユーザを登録する</a></p>
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
