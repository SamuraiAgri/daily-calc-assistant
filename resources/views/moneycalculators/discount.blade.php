@extends('layouts.app')

@section('title', '割引計算 - セール価格を簡単計算 | Daily Calc Assistant')
@section('description', '割引計算ツール。2段階割引や消費税を含めた割引後価格を算出。セールやクーポン利用時の価格確認に便利です。')
@section('keywords', '割引計算,セール価格,割引率計算,クーポン計算,値引き計算')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>割引計算</h1>
        <p class="calculator-description">元の金額に対する割引後の金額を計算します。<br>買い物やサービスの割引を確認する際に役立つツールです。</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('calculator.discount') }}">
        @csrf
        <label for="amount">元の金額</label>
        <input type="number" name="amount" id="amount" placeholder="5000" value="{{ old('amount') }}" required><br>

        <label for="unit">単位</label>
        <input type="radio" name="unit" value="yen" checked> 円
        <input type="radio" name="unit" value="man"> 万円<br>

        <label for="tax_rate">消費税率 (%)</label>
        <input type="radio" name="tax_rate" value="5"> 5%
        <input type="radio" name="tax_rate" value="8"> 8%
        <input type="radio" name="tax_rate" value="10" checked> 10%<br>

        <label for="type">金額の種類</label>
        <input type="radio" name="type" value="tax_excluded" checked> 税抜金額
        <input type="radio" name="type" value="tax_included"> 税込金額<br>

        <label for="discount_rate1">1回目の割引率 (%)</label>
        <input type="number" name="discount_rate1" id="discount_rate1" placeholder="10" required><br>

        <label for="discount_rate2">2回目の割引率 (%)</label>
        <input type="number" name="discount_rate2" id="discount_rate2" placeholder="5" required><br>

        <label for="rounding">端数処理</label>
        <select name="rounding" id="rounding">
            <option value="round">四捨五入</option>
            <option value="floor">切り捨て</option>
            <option value="ceil">切り上げ</option>
        </select><br>

        <button type="submit">計算</button>
    </form>
@endsection
