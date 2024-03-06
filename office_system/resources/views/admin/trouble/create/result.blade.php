@extends('adminlte::page')
@section('title', config('app.name') . '| 障害登録完了')

@section('content')
    @csrf
    <div class="container">
        <div class="main container-fluid">
            <div class="row bg-light text-dark py-5">
                <div class="col-md-8 offset-md-2">
                    <h2 class="fs-1 mb-5 text-center fw-bold">障害登録完了画面</h2>
                    <h2 class="text-center text-primary">障害登録が完了しました。</h2>
                    <p class="text-center">
                        <b>
                            以下のボタンより一覧画面に戻ってください。<br>
                            ブラウザバックは不正遷移と見做されるのでご注意ください。
                        </b>
                    </p>
                    <div class="d-flex justify-content-center">
                        <p><a href="{{ route('admin.trouble.index') }}" class="m-5 btn btn-success">一覧画面に戻る</a></p>
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
