@extends('layouts.app')

@section('title', '積立計算 - 将来の貯蓄額をシミュレーション | Daily Calc Assistant')
@section('description', '毎月の積立額から将来の貯蓄総額を計算。満期一括課税・複利毎課税・ボーナス併用など、さまざまな積立パターンをシミュレーションできます。')
@section('keywords', '積立計算,貯金シミュレーション,複利計算,積立投資,将来価値計算,満期一括課税,複利毎課税')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>積立計算</h1>
        <p class="calculator-description">毎月の積み立て金額を入力して、将来の積み立て総額を計算します。<br>貯金や投資計画を立てる際に最適なツールです。</p>
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

    <h2>満期一括課税</h2>
    <p>毎月の積み立て金額を入力して、将来の積み立て総額を計算します。<br>貯金や投資計画を立てる際に最適なツールです。</p>

    <h2>満期一括課税</h2>
    <p>満期時に一括で課税される方式です。積立期間中の利益がすべて満期時に課税されます。</p>
    <form method="POST" action="{{ route('calculator.savingsLumpSum') }}">
        @csrf
        <label for="monthly_amount">毎月積立額（万円）</label>
        <input type="number" name="monthly_amount" id="monthly_amount" placeholder="5" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="1.5" step="0.01" required><br>

        <label for="years">積立期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="10" required><br>

        <button type="submit">計算</button>
    </form>

    <h2>複利毎課税</h2>
    <p>毎年の利益に対して課税される方式です。利益が複利計算され、毎年課税されます。</p>
    <form method="POST" action="{{ route('calculator.savingsCompoundTax') }}">
        @csrf
        <label for="monthly_amount">毎月積立額（万円）</label>
        <input type="number" name="monthly_amount" id="monthly_amount" placeholder="5" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="1.5" step="0.01" required><br>

        <label for="years">積立期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="10" required><br>

        <button type="submit">計算</button>
    </form>

    <h2>ボーナス併用 満期一括課税</h2>
    <p>ボーナス月に追加で積み立てを行い、満期時に一括で課税される方式です。</p>
    <form method="POST" action="{{ route('calculator.savingsBonusLumpSum') }}">
        @csrf
        <label for="monthly_amount">毎月積立額（万円）</label>
        <input type="number" name="monthly_amount" id="monthly_amount" placeholder="5" required><br>

        <label for="bonus_amount">ボーナス積立額（万円）</label>
        <input type="number" name="bonus_amount" id="bonus_amount" placeholder="10" required><br>
        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="1.5" step="0.01" required><br>

        <label for="years">積立期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="10" required><br>

        <button type="submit">計算</button>
    </form>

    <h2>ボーナス併用 複利毎課税</h2>
    <p>ボーナス月に追加で積み立てを行い、毎年の利益に対して複利課税される方式です。</p>
    <form method="POST" action="{{ route('calculator.savingsBonusCompoundTax') }}">
        @csrf
        <label for="monthly_amount">毎月積立額（万円）</label>
        <input type="number" name="monthly_amount" id="monthly_amount" placeholder="5" required><br>

        <label for="bonus_amount">ボーナス積立額（万円）</label>
        <input type="number" name="bonus_amount" id="bonus_amount" placeholder="10" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="1.5" step="0.01" required><br>

        <label for="years">積立期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="10" required><br>

        <button type="submit">計算</button>
    </form>
@endsection
