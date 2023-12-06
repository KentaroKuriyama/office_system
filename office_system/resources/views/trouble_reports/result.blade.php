<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }} | 障害報告完了</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
        @csrf
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">障害報告完了画面</h2>
                            <h2 class="text-center text-primary">障害報告が完了しました。</h2>
                            <div class="d-flex justify-content-between">
                                <p><a href="{{ route('home') }}" class="m-5 btn btn-success">トップ画面に戻る</a></p>
                                <p><a href="{{ route('trouble_report.input') }}" class="m-5 btn btn-primary">別の障害を報告する</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
