@extends('layouts.app')

@section('title', 'Daily Calc Assistant - 無料の計算ツール')
@section('description', '日常生活で役立つ無料の計算ツール。ローン計算、積立計算、税金計算、年齢計算などが簡単にできます。')

@section('content')
    <!-- ヒーローセクション -->
    <section class="hero">
        <div class="hero-content">
            <h1>Daily Calc Assistant</h1>
            <p>簡単でシンプルな計算ツールを、<br>どこからでも使えます。</p>
            <a href="#features" class="cta-button">計算を始める</a>
        </div>
    </section>

    <!-- サイト紹介セクション -->
    <section id="features" class="features">
        <h2>計算ツール一覧</h2>
        <div class="feature-list">
            <a href="{{ route('calculator.loan') }}" class="feature-item">
                <h3>💰 ローン計算</h3>
                <p>借入金額や利率からローン返済額を計算</p>
            </a>
            <a href="{{ route('calculator.savings') }}" class="feature-item">
                <h3>📈 積み立て計算</h3>
                <p>毎月の積み立てをシミュレーション</p>
            </a>
            <a href="{{ route('calculator.interest') }}" class="feature-item">
                <h3>💵 利息計算</h3>
                <p>元金と利率から利息を計算</p>
            </a>
            <a href="{{ route('calculator.splitBill') }}" class="feature-item">
                <h3>👥 割り勘計算</h3>
                <p>合計金額を人数で割り勘</p>
            </a>
            <a href="{{ route('calculator.tax') }}" class="feature-item">
                <h3>🧾 税金計算</h3>
                <p>消費税を簡単に計算</p>
            </a>
            <a href="{{ route('calculator.discount') }}" class="feature-item">
                <h3>🏷️ 割引計算</h3>
                <p>割引後の金額を計算</p>
            </a>
            <a href="{{ route('datecalculator.age') }}" class="feature-item">
                <h3>🎂 年齢計算</h3>
                <p>生年月日から現在の年齢を計算</p>
            </a>
            <a href="{{ route('datecalculator.schoolYears') }}" class="feature-item">
                <h3>🎓 入学卒業年計算</h3>
                <p>学校の入学・卒業年を計算</p>
            </a>
            <a href="{{ route('datecalculator.daysSince') }}" class="feature-item">
                <h3>📅 日数計算</h3>
                <p>指定日からの経過日数を計算</p>
            </a>
        </div>
    </section>
@endsection