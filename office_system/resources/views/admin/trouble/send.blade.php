@extends('adminlte::page')
@section('title', config('app.name') . '| 返信画面')

@section('content')
    <div class="container">
        <div class="main container-fluid">
            <div class="row bg-light text-dark py-5">
                <div class="col-md-8 offset-md-2">
                    <h2 class="fs-1 mb-5 text-center fw-bold">障害報告返信画面</h2>
                    <p>以下の項目に必要事項を入力してください</p>
                    <form method="post" action="{{ route('admin.trouble.mail.result', ['id' => $trouble->id]) }}">
                        @csrf
                        <div class="mb-4">
                            <h5><b>件名</b></h5>
                            @error('subject')
                                <b><span class="text-danger">・{{ $message }}</span></b>
                            @enderror
                            <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"
                                rows="5">
                        </div>
                        <div class="mb-4">
                            <h5><b>本文</b></h5>
                            @error('text')
                                <b><span class="text-danger">・{{ $message }}</span></b>
                            @enderror
                            <textarea class="form-control" name="text" rows="5">{{ old('text') }}</textarea>
                        </div>
                        <div class="text-center pt-4 col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary submit"
                                onclick="return confirm('メールを送信しますか？');">送信する</button>
                        </div>
                    </form>
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
