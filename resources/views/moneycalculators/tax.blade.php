@extends('layouts.app')

@section('title', '消費税計算 - 税込・税抜価格を簡単計算 | Daily Calc Assistant')
@section('description', '消費税の計算を簡単に。税込価格から税抜価格、税抜価格から税込価格への変換が可能。端数処理も四捨五入・切り捨て・切り上げから選択できます。')
@section('keywords', '消費税計算,税込計算,税抜計算,消費税8%,消費税10%,税金計算')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>消費税計算</h1>
        <p class="calculator-description">指定した金額に対して税金を計算します。<br>日本の消費税率に基づいて簡単に計算でき、税抜きや税込み価格を確認するのに便利です。</p>
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
     <form method="POST" action="{{ route('calculator.tax') }}">
        @csrf
        <label for="amount">金額</label>
        <input type="number" name="amount" id="amount" placeholder="100" required><br>

        <label for="unit">単位</label>
        <input type="radio" name="unit" value="yen" checked> 円
        <input type="radio" name="unit" value="man"> 万円<br>

        <label for="tax_rate">消費税率 (%)</label>
        <input type="number" name="tax_rate" id="tax_rate" placeholder="10" step="0.01" required><br>

        <label for="type">金額の種類</label>
        <select name="type" id="type">
            <option value="tax_excluded">税抜金額</option>
            <option value="tax_included">税込金額</option>
        </select><br>

        <label for="rounding">端数処理</label>
        <select name="rounding" id="rounding">
            <option value="round">四捨五入</option>
            <option value="floor">切り捨て</option>
            <option value="ceil">切り上げ</option>
        </select><br>

        <button type="submit">計算</button>
    </form>
@endsection
