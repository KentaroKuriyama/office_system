<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }} | ユーザ編集</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">ユーザ編集画面</h2>
                            @if (session('error'))
                                <div class="alert alert-success text-center fw-bold">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <p>以下の項目に必要事項を入力してください</p>
                            <form method="post" action="{{ route('admin.user.edit.send', ['id' => $user->id]) }}">
                                @csrf
                                <div class="col-md-6 mb-3">
                                    <h5><b>ユーザ名</b></h5>
                                    @error('name')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5><b>ログインID</b></h5>
                                    @error('login_id')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <input type="text" name="login_id" class="form-control" value="{{ old('login_id', $user) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5><b>メールアドレス</b></h5>
                                    @error('email')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5><b>パスワード</b></h5>
                                    @error('password')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <input type="password" name="password" class="form-control" value="{{ old('password, $user') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5><b>権限</b></h5>
                                    @error('role_id')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <select name="role_id" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-center pt-4 col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary">登録する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
