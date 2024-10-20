@extends('layouts.app')

@section('content')
    <h1>消費税計算</h1>
    <p>指定した金額に対して税金を計算します。<br>日本の消費税率に基づいて簡単に計算でき、税抜きや税込み価格を確認するのに便利です。</p>
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
