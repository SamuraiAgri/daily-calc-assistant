@extends('layouts.app')

@section('content')
    <!-- ヒーローセクション -->
    <section class="hero">
        <div class="hero-content">
            <p>簡単でシンプルな計算ツールを、どこからでも使えます。</p>
            <a href="#features" class="cta-button">計算を始める</a>
        </div>
    </section>

    <!-- サイト紹介セクション -->
    <section id="features" class="features">
        <div class="feature-list">
            <a href="{{ route('calculator.loan') }}" class="feature-item">
                <h3>ローン計算</h3>
                <p>借入金額や利率からローン返済額を計算。</p>
            </a>
            <a href="{{ route('calculator.savings') }}" class="feature-item">
                <h3>積み立て<br>計算</h3>
                <p>毎月の積み立て金額をシミュレーション。</p>
            </a>
            <a href="{{ route('calculator.interest') }}" class="feature-item">
                <h3>利息計算</h3>
                <p>元金と利率を元に利息を計算。</p>
            </a>
            <a href="{{ route('calculator.splitBill') }}" class="feature-item">
                <h3>割り勘計算</h3>
                <p>合計金額を人数で割り勘。</p>
            </a>
            <a href="{{ route('calculator.tax') }}" class="feature-item">
                <h3>税金計算</h3>
                <p>消費税を計算。</p>
            </a>
            <a href="{{ route('calculator.discount') }}" class="feature-item">
                <h3>割引計算</h3>
                <p>割引率を使って金額を計算。</p>
            </a>
            <a href="{{ route('datecalculator.age') }}" class="feature-item">
                <h3>年齢計算</h3>
                <p>生年月日から現在の年齢を計算。</p>
            </a>
            <a href="{{ route('datecalculator.schoolYears') }}" class="feature-item">
                <h3>入学卒業年<br>計算</h3>
                <p>生年月日から学校の入学と卒業年を計算。</p>
            </a>
        </div>
    </section>
@endsection