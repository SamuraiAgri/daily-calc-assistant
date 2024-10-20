@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>消費税計算結果</h1>

    <p>税抜金額 <strong>{{ number_format($amountExcludingTax, 0) }} 円</strong></p>
    <p>税額 <strong>{{ number_format($taxAmount, 0) }} 円</strong></p>
    <p>税込金額 <strong>{{ number_format($amountIncludingTax, 0) }} 円</strong></p>

    <a href="{{ route('calculator.tax') }}">再計算する</a>
</div>
@endsection
