<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}} | 障害登録</title>
    </head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="container">
                <div class="main container-fluid">
                    <div class="row bg-light text-dark py-5">
                        <div class="col-md-8 offset-md-2">
                            <h2 class="fs-1 mb-5 text-center fw-bold">障害登録画面</h2>
                            @if (session('error'))
                                <div class="alert alert-success text-center fw-bold">
                                    {{session('error')}}
                                </div>
                            @endif
                            <p>以下の項目に必要事項を入力してください</p>
                            <form method="post" action="{{route('admin.trouble.edit.send', ['id' => $trouble->id])}}">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5><b>機能</b></h5>
                                        @error('function')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <select name="function" class="form-control">
                                            @foreach(config('const.trouble.function') as $key => $value)
                                                <option value="{{$key}}" {{old('function', $trouble) == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5><b>発生日時</b></h5>
                                        @error('occurred_at')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <input type="datetime-local" name="occurred_at" class="form-control" value="{{old('occurred_at', $trouble)}}">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h5><b>現象</b></h5>
                                    @error('phenomenon')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <textarea class="form-control" name="phenomenon" rows="5">{{old('phenomenon', $trouble)}}</textarea>
                                </div>
                                <div class="mb-4">
                                    <h5><b>再現手順</b></h5>
                                    @error('reproduction_steps')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <textarea class="form-control" name="reproduction_steps" rows="5">{{old('reproduction_steps', $trouble)}}</textarea>
                                </div>
                                <div class="mb-4">
                                    <h5><b>原因</b></h5>
                                    @error('cause')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <textarea class="form-control" name="cause" rows="5">{{old('cause', $trouble)}}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5><b>原因種別</b></h5>
                                        @error('cause_type')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <select name="cause_type" class="form-control">
                                            <option value="" {{old('cause_type', $trouble) == '' ? 'selected' : ''}}>選択しない</option>
                                            @foreach(config('const.trouble.cause_type') as $key => $value)
                                                <option value="{{$key}}" {{old('cause_type', $trouble) == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5><b>原因工程</b></h5>
                                        @error('cause_process')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <select name="cause_process" class="form-control">
                                            <option value="" {{old('cause_process', $trouble) == '' ? 'selected' : ''}}>選択しない</option>
                                            @foreach(config('const.trouble.cause_process') as $key => $value)
                                                <option value="{{$key}}" {{old('cause_process', $trouble) == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5><b>担当者</b></h5>
                                        @error('corresponding_user_id')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <select name="corresponding_user_id" class="form-control">
                                            <option value="" {{old('corresponding_user_id', $trouble) == '' ? 'selected' : ''}}>まだ決まっていない</option>
                                            @foreach($admins as $admin)
                                                <option value="{{$admin->id}}" {{old('corresponding_user_id', $trouble) == $admin->id ? 'selected' : ''}}>{{$admin->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5><b>対応期限</b></h5>
                                        @error('corresponding_limit')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <input type="date" class="form-control" name="corresponding_limit" value="{{old('corresponding_limit', $trouble)}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h5><b>優先度</b></h5>
                                        @error('priority')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <select name="priority" class="form-control">
                                            @foreach(config('const.trouble.priority') as $key => $value)
                                                <option value="{{$key}}" {{old('priority', $trouble) == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h5><b>ステータス</b></h5>
                                        @error('status')
                                            <b><span class="text-danger">・{{$message}}</span></b>
                                        @enderror
                                        <select name="status" class="form-control">
                                            @foreach(config('const.trouble.status') as $key => $value)
                                                <option value="{{$key}}" {{old('status', $trouble) == $key ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h5><b>備考</b></h5>
                                    @error('remarks')
                                        <b><span class="text-danger">・{{$message}}</span></b>
                                    @enderror
                                    <textarea class="form-control" name="remarks" rows="5">{{old('remarks', $trouble)}}</textarea>
                                </div>
                                <div class="text-center pt-4 col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary submit">障害を登録する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>
</html>
