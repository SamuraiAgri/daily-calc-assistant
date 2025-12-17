@extends('layouts.app')

@section('title', '404 ページが見つかりません | Daily Calc Assistant')
@section('description', 'お探しのページは見つかりませんでした。')

@section('content')
<div class="error-container">
    <div class="error-content">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">ページが見つかりません</h2>
        <p class="error-message">
            お探しのページは削除されたか、URLが変更された可能性があります。
        </p>
        
        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn btn-primary">ホームに戻る</a>
        </div>
        
        <div class="error-suggestions">
            <h3>お探しの情報はこちらかもしれません</h3>
            <ul>
                <li><a href="{{ route('calculator.loan') }}">ローン計算</a></li>
                <li><a href="{{ route('calculator.savings') }}">積立計算</a></li>
                <li><a href="{{ route('calculator.tax') }}">税金計算</a></li>
                <li><a href="{{ route('datecalculator.age') }}">年齢計算</a></li>
                <li><a href="{{ route('blog.index') }}">ブログ</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
