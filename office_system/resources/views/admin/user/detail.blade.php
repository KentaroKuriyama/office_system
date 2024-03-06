@extends('adminlte::page')
@section('title', config('app.name') . '| ユーザ詳細')

@section('content')
    <div class="container">
        <div class="main container-fluid">
            <div class="row bg-light text-dark py-5">
                <div class="col-md-8 offset-md-2">
                    <h2 class="fs-1 mb-5 text-center fw-bold">ユーザ詳細一覧</h2>
                    <p>編集を行いたい場合、編集するを押してください</p>
                    @csrf
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>名前</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>ログインID</th>
                                <td>{{ $user->login_id }}</td>
                            </tr>
                            <tr>
                                <th>権限</th>
                                <td>{{ $user->role->name }}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>作成日</th>
                                <td>{{ $createdAt != null ? $createdAt->format('Y年m月d日') : '' }}</td>
                            </tr>
                            <tr>
                                <th>更新日</th>
                                <td>{{ $updatedAt != null ? $updatedAt->format('Y年m月d日') : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between mb-4">
                        <div class="text-center col-md-6 mb-3">
                            <a href="{{ route('admin.user.edit.input', ['id' => $user->id]) }}"><button type="submit"
                                    class="btn btn-primary">編集する</button></a>
                        </div>
                        <div class="text-center col-md-6 mb-3">
                            <a href="{{ route('admin.user.index') }}"><button type="submit"
                                    class="btn btn-success">一覧に戻る</button></a>
                        </div>
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
