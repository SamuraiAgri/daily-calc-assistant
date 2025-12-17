@extends('layouts.app')

@section('title', '利息計算 - 元金と利率から利息を算出 | Daily Calc Assistant')
@section('description', '元金、利率、期間を入力して利息を計算。預金や投資の利回りを簡単にシミュレーションできます。')
@section('keywords', '利息計算,金利計算,預金利息,単利計算,投資シミュレーション')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>利息計算</h1>
        <p class="calculator-description">元金、利率、期間を入力して、元金に対する利息を計算します。<br>金融計画や投資計画を立てる際に役立ちます。</p>
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

    <form method="POST" action="{{ route('calculator.interest') }}">
        @csrf
        <label for="principal">元金（円）</label>
        <input type="number" name="principal" id="principal" placeholder="1000000" value="{{ old('principal') }}" required>

        <label for="rate">利率 (%)</label>
        <input type="number" name="rate" id="rate" step="0.01" placeholder="1.5" value="{{ old('rate') }}" required>

        <label for="years">期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="5" value="{{ old('years') }}" required>

        <button type="submit">計算</button>
    </form>
</div>
@endsection
