<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }} | ユーザ一覧</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="container">
                <a href="{{ route('admin.user.create.input') }}" class="btn btn-primary">ユーザ新規登録へ</a>
                <h1 style="padding-top:50px;">ユーザ一覧</h1>
                @if (session('success'))
                    <div class="alert alert-primary text-center fw-bold success-message" data-timeout="3000">
                        {{ session('success') }}
                    </div>
                @elseif (session('delete'))
                    <div class="alert alert-success text-center fw-bold delete-message" data-timeout="3000">
                        {{ session('delete') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger text-center fw-bold error-message" data-timeout="3000">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-bordered table-striped task-table table-hover">
                    <thead>
                        <tr class="bg-dark text-light text-center">
                            <th>@sortablelink('id', 'ID')</th>
                            <th>@sortablelink('name', 'ユーザ名')</th>
                            <th>@sortablelink('role_id', '権限')</th>
                            <th>@sortablelink('email', 'メールアドレス')</th>
                            <th>@sortablelink('created_at', '作成日時')</th>
                            <th>@sortablelink('updated_at', '更新日時')</th>
                            <th>詳細</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center align-middle">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role->name}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y年m月d日') }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('Y年m月d日') }}</td>
                                <td>
                                    <a href="{{ route('admin.user.detail', ['id' => $user->id]) }}">
                                        <button type="submit" class="btn btn-secondary">詳細</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.edit.input', ['id' => $user->id]) }}">
                                        <button type="submit" class="btn btn-primary">編集</button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.user.delete', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger submit" onclick="return confirm('本当に削除しますか？');">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{$users->appends(request()->query())->links()}}
            </div>
        @endsection
    </body>
</html>
