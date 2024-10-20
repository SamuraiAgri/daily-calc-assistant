@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>割引計算結果</h1>

    <p>元の金額 <strong>{{ number_format($amount, 0) }} 円</strong></p>
    <p>1回目の割引率 <strong>{{ $discountRate1 }} %</strong></p>
    <p>2回目の割引率 <strong>{{ $discountRate2 }} %</strong></p>
    <p>消費税率 <strong>{{ $taxRate }} %</strong></p>
    <p>合計割引額 <strong>{{ number_format($totalDiscount, 0) }} 円</strong></p>
    <p>割引後の金額（税抜、{{ $rounding }}処理） <strong>{{ number_format($discountedAmount, 0) }} 円</strong></p>
    <p>割引後の金額（税込） <strong>{{ number_format($discountedAmountIncludingTax, 0) }} 円</strong></p>

    <a href="{{ route('calculator.discount') }}">再計算する</a>
</div>
@endsection
