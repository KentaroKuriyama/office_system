@extends('adminlte::page')
@section('title', config('app.name') . '| 障害')

@section('content')
    <div class="container">
        <a href="{{ route('admin.trouble.create.input') }}" class="btn btn-primary">障害を登録する</a>
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
        <div class="col-12">
            <table class="table table-bordered table-striped task-table table-hover">
                <thead>
                    <tr class="bg-dark text-light text-center">
                        <th class="text-sm text-nowrap">@sortablelink('id', 'ID')</th>
                        <th class="text-sm text-nowrap">@sortablelink('function', '機能')</th>
                        <th class="text-sm text-nowrap">@sortablelink('corresponding_user_id', '対応者')</th>
                        <th class="text-sm text-nowrap">@sortablelink('corresponding_limit', '対応期限')</th>
                        <th class="text-sm text-nowrap">@sortablelink('priority', '優先度')</th>
                        <th class="text-sm text-nowrap">@sortablelink('status', 'ステータス')</th>
                        <th class="text-sm text-nowrap">@sortablelink('register_type', '登録種別')</th>
                        <th class="text-sm text-nowrap">@sortablelink('created_at', '作成日時')</th>
                        <th class="text-sm text-nowrap">@sortablelink('updated_at', '更新日時')</th>
                        <th class="text-sm text-nowrap">詳細</th>
                        <th class="text-sm text-nowrap">編集</th>
                        <th class="text-sm text-nowrap">メール送信</th>
                        <th class="text-sm text-nowrap">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($troubles as $trouble)
                        <tr class="text-center align-middle">
                            <td class="text-sm text-nowrap">{{ $trouble->id }}</td>
                            <td class="text-sm text-nowrap">{{ config('const.trouble.function')[$trouble->function] }}</td>
                            <td class="text-sm text-nowrap">
                                {{ !empty($trouble->corresponding_user_id) ? $trouble->user->name : '' }}</td>
                            <td class="text-sm text-nowrap">
                                {{ !empty($trouble->corresponding_limit) ? \Carbon\Carbon::parse($trouble->corresponding_limit)->format('Y年m月d日') : '' }}
                            </td>
                            <td class="text-sm text-nowrap">{{ config('const.trouble.priority')[$trouble->priority] }}</td>
                            <td class="text-sm text-nowrap">{{ config('const.trouble.status')[$trouble->status] }}</td>
                            <td class="text-sm text-nowrap">
                                {{ config('const.trouble.register_type')[$trouble->register_type] }}</td>
                            <td class="text-sm text-nowrap">
                                {{ \Carbon\Carbon::parse($trouble->created_at)->format('Y年m月d日') }}</td>
                            <td class="text-sm text-nowrap">
                                {{ !empty($trouble->updated_at) ? \Carbon\Carbon::parse($trouble->updated_at)->format('Y年m月d日') : '' }}
                            </td>
                            <td class="text-sm text-nowrap">
                                <a href="{{ route('admin.trouble.detail', ['id' => $trouble->id]) }}">
                                    <button type="submit" class="btn btn-secondary btn-sm">詳細</button>
                                </a>
                            </td>
                            <td class="text-sm text-nowrap">
                                <a href="{{ route('admin.trouble.edit.input', ['id' => $trouble->id]) }}">
                                    <button type="submit" class="btn btn-primary btn-sm">編集</button>
                                </a>
                            </td>
                            <td class="text-sm text-nowrap">
                                @if ($trouble->register_type == 1)
                                    <a href="{{ route('admin.trouble.mail.send', ['id' => $trouble->id]) }}">
                                        <button type="submit" class="btn btn-primary btn-sm">メール送信</button>
                                    </a>
                                @endif
                            </td>
                            <td class="text-sm text-nowrap">
                                <form action="{{ route('admin.trouble.delete', ['id' => $trouble->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm submit"
                                        onclick="return confirm('本当に削除しますか？');">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $troubles->appends(request()->query())->links() }}
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
