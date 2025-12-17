@extends('layouts.app')

@section('title', 'アクセス制限 | Daily Calc Assistant')

@section('content')
<div class="error-container">
    <div class="error-content">
        <h1 class="error-code error-code--429">429</h1>
        <h2 class="error-title">リクエストが多すぎます</h2>
        <p class="error-message">
            短時間に多くのリクエストが送信されました。<br>
            <strong>{{ $retryAfter ?? 60 }}秒後</strong>に再度お試しください。
        </p>
        
        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">ホームに戻る</a>
        </div>
    </div>
</div>
@endsection
