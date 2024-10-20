@extends('layouts.app')

@section('content')
    <h1>利息計算</h1>
    <p>元金、利率、期間を入力して、元金に対する利息を計算します。<br>金融計画や投資計画を立てる際に役立ちます。</p>
    <form method="POST" action="{{ route('calculator.interest') }}">
        @csrf
        <label for="principal">元金</label>
        <input type="number" name="principal" id="principal" required>

        <label for="rate">利率 (%)</label>
        <input type="number" name="rate" id="rate" step="0.01" required>

        <label for="years">期間 (年)</label>
        <input type="number" name="years" id="years" required>

        <button type="submit">計算</button>
    </form>
@endsection
