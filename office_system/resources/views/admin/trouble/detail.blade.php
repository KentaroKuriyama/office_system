<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}} | 障害詳細</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
        <div class="container">
            <div class="main container-fluid">
                <div class="row bg-light text-dark py-5">
                    <div class="col-md-8 offset-md-2">
                        <h2 class="fs-1 mb-5 text-center fw-bold">障害詳細</h2>
                        <p>編集を行いたい場合、編集するを押してください</p>
                        @csrf
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{$trouble->id}}</td>
                                </tr>
                                <tr>
                                    <th>機能</th>
                                    <td>{{config('const.trouble.function')[$trouble->function]}}</td>
                                </tr>
                                <tr>
                                    <th>発生日時</th>
                                    <td>{{\Carbon\Carbon::parse($trouble->created_at)->format('Y年m月d日')}}</td>
                                </tr>
                                <tr>
                                    <th>現象</th>
                                    <td>{!!nl2br(e($trouble->phenomenon))!!}</td>
                                </tr>
                                <tr>
                                    <th>再現手順</th>
                                    <td>{!!nl2br(e($trouble->reproduction_steps))!!}</td>
                                </tr>
                                <tr>
                                    <th>原因</th>
                                    <td>{!!!empty($trouble->cause) ? nl2br(e($trouble->cause)) : ''!!}</td>
                                </tr>
                                <tr>
                                    <th>原因種別</th>
                                    <td>{{!empty($trouble->cause_type) ? config('const.trouble.cause_type')[$trouble->cause_type] : ''}}</td>
                                </tr>
                                <tr>
                                    <th>原因工程</th>
                                    <td>{{!empty($trouble->cause_process) ? config('const.trouble.cause_process')[$trouble->cause_process] : ''}}</td>
                                </tr>
                                <tr>
                                    <th>担当者</th>
                                    <td>{{!empty($trouble->user->name) ? $trouble->user->name : ''}}</td>
                                </tr>
                                <tr>
                                    <th>対応期限</th>
                                    <td>{{!empty($trouble->corresponding_limit) ? $trouble->corresponding_limit : ''}}</td>
                                </tr>
                                <tr>
                                    <th>優先度</th>
                                    <td>{{config('const.trouble.priority')[$trouble->priority]}}</td>
                                </tr>
                                <tr>
                                    <th>備考</th>
                                    <td>{!!!empty($trouble->remarks) ? nl2br(e($trouble->remarks)) : ''!!}</td>
                                </tr>
                                <tr>
                                    <th>ステータス</th>
                                    <td>{{config('const.trouble.status')[$trouble->status]}}</td>
                                </tr>
                                <tr>
                                    <th>登録種別</th>
                                    <td>{{config('const.trouble.register_type')[$trouble->register_type]}}</td>
                                </tr>
                                <tr>
                                    <th>作成者</th>
                                    <td>{{!empty($createUser->name) ? $createUser->name : ''}}</td>
                                </tr>
                                <tr>
                                    <th>更新者</th>
                                    <td>{{!empty($updateUser->name) ? $updateUser->name : ''}}</td>
                                </tr>
                                <tr>
                                    <th>作成日時</th>
                                    <td>{{!empty($trouble->created_at) ? \Carbon\Carbon::parse($trouble->created_at)->format('Y年m月d日') : ''}}</td>
                                </tr>
                                <tr>
                                    <th>更新日時</th>
                                    <td>{{!empty($trouble->created_at) ? \Carbon\Carbon::parse($trouble->updated_at)->format('Y年m月d日') : ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="text-center col-md-6 mb-3">
                                <a href="{{route('admin.trouble.edit.input', ['id' => $trouble->id])}}"><button type="submit" class="btn btn-primary">編集する</button></a>
                            </div>
                            <div class="text-center col-md-6 mb-3">
                                <a href="{{route('admin.trouble.index')}}"><button type="submit" class="btn btn-success">一覧に戻る</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
    </body>
</html>
