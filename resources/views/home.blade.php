@extends('layouts.app')

@section('content')
    <!-- ヒーローセクション -->
    <section class="hero">
        <div class="hero-content">
            <p>シンプルで使いやすい計算ツールで、日々の生活をもっと便利に。</p>
            <a href="#features" class="cta-button">計算を始める</a>
        </div>
    </section>

    <!-- サイト紹介セクション -->
    <section id="features" class="features">
        <div class="feature-list">
            <a href="{{ route('calculator.loan') }}" class="feature-item">
                <h3>ローン計算</h3>
                <p>借入金額、利率、返済期間を入力してローン返済額を計算します。</p>
            </a>
            <a href="{{ route('calculator.savings') }}" class="feature-item">
                <h3>積み立て計算</h3>
                <p>積み立て金額と利率から将来の貯金額を計算します。</p>
            </a>
            <a href="{{ route('calculator.interest') }}" class="feature-item">
                <h3>利息計算</h3>
                <p>元金と利率を使って利息を計算します。</p>
            </a>
            <a href="{{ route('calculator.splitBill') }}" class="feature-item">
                <h3>割り勘計算</h3>
                <p>合計金額を人数で割り勘計算します。</p>
            </a>
            <a href="{{ route('calculator.tax') }}" class="feature-item">
                <h3>税金計算</h3>
                <p>金額に対して消費税を計算します。</p>
            </a>
            <a href="{{ route('calculator.discount') }}" class="feature-item">
                <h3>割引計算</h3>
                <p>割引率を使って割引後の金額を計算します。</p>
            </a>
            <a href="{{ route('datecalculator.age') }}" class="feature-item">
                <h3>年齢計算</h3>
                <p>生年月日から現在の年齢を計算します。</p>
            </a>
            <a href="{{ route('datecalculator.schoolYears') }}" class="feature-item">
                <h3>入学卒業年計算</h3>
                <p>生年月日から学校の入学と卒業年を計算します。</p>
            </a>
            <a href="{{ route('datecalculator.daysSince') }}" class="feature-item">
                <h3>日数計算</h3>
                <p>特定の日から今日までの経過日数を計算します。</p>
            </a>
        </div>
    </section>
@endsection
