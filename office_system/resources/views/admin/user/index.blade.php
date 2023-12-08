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
                    @if (session('delete'))
                        <div class="alert alert-success text-center fw-bold">
                            {{ session('delete') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger text-center fw-bold">
                            {{ session('error') }}
                        </div>
                    @endif
                <table class="table table-bordered table-striped task-table table-hover">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th>ID</th>
                            <th>ユーザ名</th>
                            <th>権限</th>
                            <th>メールアドレス</th>
                            <th>作成日時</th>
                            <th>更新日時</th>
                            <th>詳細</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</a></td>
                                <td>{{ $user->role->name}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
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
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endsection
    </body>
</html>
