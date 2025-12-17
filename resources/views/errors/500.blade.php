@extends('layouts.app')

@section('title', '500 サーバーエラー | Daily Calc Assistant')
@section('description', 'サーバーエラーが発生しました。')

@section('content')
<div class="error-container">
    <div class="error-content">
        <h1 class="error-code error-code--500">500</h1>
        <h2 class="error-title">サーバーエラー</h2>
        <p class="error-message">
            申し訳ございません。サーバーで問題が発生しました。<br>
            しばらくしてから再度お試しください。
        </p>
        
        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">ホームに戻る</a>
            <button onclick="location.reload()" class="btn btn-secondary">再読み込み</button>
        </div>
        
        <div class="error-contact">
            <p>問題が解決しない場合は、<a href="{{ route('contact') }}">お問い合わせ</a>ください。</p>
        </div>
    </div>
</div>
@endsection
