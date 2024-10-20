@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>割り勘計算結果</h1>
    <p>合計金額 <strong>{{ number_format($totalAmount, 0) }} 円</strong></p>
    <p>人数 <strong>{{ $numPeople }} 人</strong></p>

    <h2>各人の支払額</h2>
    <ul>
        @foreach ($adjustedAmounts as $index => $amount)
            <li>{{ $index + 1 }} 人目 <strong>{{ $amount }} 円</strong></li>
        @endforeach
    </ul>

    <a href="{{ route('calculator.splitBill') }}">再計算する</a>
</div>
@endsection
