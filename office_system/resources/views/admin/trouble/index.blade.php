<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}} | 障害</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="container">
                <a href="{{route('admin.trouble.create.input')}}" class="btn btn-primary">障害を登録する</a>
                <h1 style="padding-top:50px;">障害一覧</h1>
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
                            <th>@sortablelink('function', '機能')</th>
                            <th>@sortablelink('corresponding_user_id', '対応者')</th>
                            <th>@sortablelink('corresponding_limit', '対応期限')</th>
                            <th>@sortablelink('priority', '優先度')</th>
                            <th>@sortablelink('status', 'ステータス')</th>
                            <th>@sortablelink('register_type', '登録種別')</th>
                            <th>@sortablelink('created_at', '作成日時')</th>
                            <th>@sortablelink('updated_at', '更新日時')</th>
                            <th>詳細</th>
                            <th>編集</th>
                            <th>メール送信</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($troubles as $trouble)
                            <tr class="text-center align-middle">
                                <td>{{$trouble->id}}</td>
                                <td>{{config('const.trouble.function')[$trouble->function]}}</td>
                                <td>{{!empty($trouble->corresponding_user_id) ? $trouble->user->name : ''}}</td>
                                <td>{{$trouble->corresponding_limit}}</td>
                                <td>{{config('const.trouble.priority')[$trouble->priority]}}</td>
                                <td>{{config('const.trouble.status')[$trouble->status]}}</td>
                                <td>{{config('const.trouble.register_type')[$trouble->register_type]}}</td>
                                <td>{{\Carbon\Carbon::parse($trouble->created_at)->format('Y年m月d日')}}</td>
                                <td>{{!empty($trouble->updated_at) ? \Carbon\Carbon::parse($trouble->updated_at)->format('Y年m月d日') : ''}}</td>
                                <td>
                                    <a href="{{route('admin.trouble.detail', ['id' => $trouble->id])}}">
                                        <button type="submit" class="btn btn-secondary">詳細</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('admin.trouble.edit.input', ['id' => $trouble->id])}}">
                                        <button type="submit" class="btn btn-primary">編集</button>
                                    </a>
                                </td>
                                <td>
                                    @if ($trouble->register_type == 1)
                                        <a href="{{route('admin.trouble.mail.send', ['id' => $trouble->id])}}">
                                            <button type="submit" class="btn btn-primary">メール送信</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.trouble.delete', ['id' => $trouble->id])}}" method="post">
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
                {{$troubles->appends(request()->query())->links()}}
            </div>
        @endsection
    </body>
</html>
