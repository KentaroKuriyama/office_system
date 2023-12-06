<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }} | ユーザ詳細</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">ユーザ詳細一覧</h2>
                            <p>編集を行いたい場合、編集するを押してください</p>
                            @csrf
                            <div class="mb-4">
                                <h5><b>名前：{{$user->name}}</b></h5>
                            </div>
                            <div class="mb-4">
                                <h5><b>ログインID：{{$user->login_id}}</b></h5>
                            </div>
                            <div class="mb-4">
                                <h5><b>権限：{{$user->role->name}}</b></h5>
                            </div>
                            <div class="mb-4">
                                <h5><b>メールアドレス：{{$user->email}}</b></h5>
                            </div>
                            <div class="mb-4">
                                <h5><b>作成日：{{ $createdAt != null ? $createdAt->format('Y年m月d日') : 'デフォルトデータです'}}</b></h5>
                            </div>
                            <div class="mb-4">
                                <h5><b>更新日：{{ $updatedAt != null ? $updatedAt->format('Y年m月d日') : 'まだ更新されていません'}}</b></h5>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div class="text-center col-md-6 mb-3">
                                    <a href="{{ route('admin.user.edit.input', ['id' => $user->id]) }}"><button type="submit" class="btn btn-primary">編集する</button></a>
                                </div>
                                <div class="text-center col-md-6 mb-3">
                                    <a href="{{ route('admin.user.index') }}"><button type="submit" class="btn btn-success">一覧に戻る</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
