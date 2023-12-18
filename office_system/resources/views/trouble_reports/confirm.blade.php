<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}} | 障害報告確認</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">障害報告確認画面</h2>
                            <p>以下の内容で報告します。修正する場合は修正ボタンを押してください。</p>
                            <form method="post" action="{{route('trouble_report.send')}}">
                                @csrf
                                <div class="col-md-6 mb-3">
                                    <h5><b>機能</b></h5>
                                    {{config('const.trouble.function')[$input['function']]}}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5><b>発生日時</b></h5>
                                    {{\Carbon\Carbon::parse($input['occurred_at'])->format('Y年m月d日 H時i分')}}
                                </div>
                                <div class="mb-4">
                                    <h5><b>現象</b></h5>
                                    {!! nl2br(e($input['phenomenon'])) !!}
                                </div>
                                <div class="mb-4">
                                    <h5><b>再現手順</b></h5>
                                    {!! nl2br(e($input['reproduction_steps'])) !!}
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="m-5 btn btn-success" name="back">修正する</button>
                                    <button type="submit" class="m-5 btn btn-primary submit">送信する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
