@extends('layouts.app')

@section('content')
    <h1>ローン返済計算</h1>
    <p>借入金額、利率、返済期間を入力して、ローンの返済額を計算します。<br>住宅ローンや自動車ローンのシミュレーションに最適です。</p>
     <form method="POST" action="{{ route('calculator.loan') }}">
        @csrf
        <label for="principal">借入金額（万円）</label>
        <input type="number" name="principal" id="principal" placeholder="300" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="3.5" step="0.01" required><br>

        <label for="years">返済期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="15" required><br>

        <label for="method">返済方法</label>
        <select name="method" id="method">
            <option value="fixed">元利均等返済</option>
            <option value="principal">元金均等返済</option>
        </select><br>

        <button type="submit">毎月払いで計算</button>
    </form>

    <h2>ボーナス併用返済はこちら</h2>
    <p>ボーナス月に追加で返済を行い、総返済額や返済期間を調整します。<br>通常の返済に加えて、ボーナス払いを組み合わせたシミュレーションが可能です。</p>
        <form method="POST" action="{{ route('calculator.loanWithBonus') }}">
        @csrf
        <label for="principal">借入金額（万円）</label>
        <input type="number" name="principal" id="principal" placeholder="300" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="3.5" step="0.01" required><br>

        <label for="years">返済期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="15" required><br>

        <label for="bonus">ボーナス返済額（万円）</label>
        <input type="number" name="bonus" id="bonus" placeholder="10" required><br>

        <label for="method">返済方法</label>
        <select name="method" id="method">
            <option value="fixed">元利均等返済</option>
            <option value="principal">元金均等返済</option>
        </select><br>

        <button type="submit">ボーナス併用払いで計算</button>
    </form>
@endsection
