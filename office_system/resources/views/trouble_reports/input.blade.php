<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }} | 障害報告入力画面</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">障害報告入力画面</h2>
                            <p>以下の項目に必要事項を入力してください</p>
                            <form method="post" action="{{ route('trouble_report.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5><b>機能</b></h5>
                                        <select name="function" class="form-control">
                                            @foreach(config('const.trouble.function') as $key => $value)
                                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5><b>発生日時</b></h5>
                                        <input type="date" name="occured_at" class="form-control" value="{{ old('occured_at') }}">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h5><b>現象</b></h5>
                                    <textarea class="form-control" name="phenomenon" rows="5">{{ old('phenomenon') }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <h5><b>再現手順</b></h5>
                                    <textarea class="form-control" name="reproduction_steps" rows="5">{{ old('reproduction_steps') }}</textarea>
                                </div>
                                <div class="text-center pt-4 col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary">確認画面へ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
