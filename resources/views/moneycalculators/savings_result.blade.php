@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>積立計算結果</h1>
    
    <p>最終積立額（税引後） <strong>{{ number_format($futureValueAfterTax ?? $finalFutureValueAfterTax, 2) }} 万円</strong></p>
    <p>利息合計 <strong>{{ number_format($interest ?? $totalInterest, 2) }} 万円</strong></p>
    @if(isset($taxAmount))
        <p>課税額 <strong>{{ number_format($taxAmount, 2) }} 万円</strong></p>
    @endif

    <a href="{{ route('calculator.savings') }}">再計算する</a>
</div>
@endsection
