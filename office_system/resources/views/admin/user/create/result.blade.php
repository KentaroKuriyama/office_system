<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}} | ユーザ登録完了</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
        @csrf
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">ユーザ登録完了画面</h2>
                            <h2 class="text-center text-primary">新規ユーザ登録が完了しました。</h2>
                            <div class="d-flex justify-content-between">
                                <p><a href="{{route('admin.user.index')}}" class="m-5 btn btn-success">一覧画面に戻る</a></p>
                                <p><a href="{{route('admin.user.create.input')}}" class="m-5 btn btn-primary">別のユーザを登録する</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
