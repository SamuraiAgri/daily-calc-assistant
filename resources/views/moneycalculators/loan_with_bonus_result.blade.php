@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>ローン返済計算結果（ボーナス併用）</h1>
    <p>支払総額 <strong>{{ number_format(ceil($totalPayment * 10000)) }} 円</strong></p>
    <p>支払利息合計 <strong>{{ number_format(ceil($totalInterest * 10000)) }} 円</strong></p>
    <h2>返済スケジュール</h2>
    <table>
        <tr>
            <th>月</th>
            <th>毎月の支払額</th>
            <th>元本</th>
            <th>利息</th>
            <th>残高</th>
        </tr>
        @foreach ($schedule as $payment)
        <tr>
            <td>{{ $payment['month'] }}</td>
            <td>{{ number_format(ceil($payment['monthlyPayment'] * 10000)) }} 円</td>
            <td>{{ number_format(ceil($payment['principalPayment'] * 10000)) }} 円</td>
            <td>{{ number_format(ceil($payment['interestPayment'] * 10000)) }} 円</td>
            <td>{{ number_format(ceil($payment['remainingPrincipal'] * 10000)) }} 円</td>
        </tr>
    @endforeach
</table>
    <a href="{{ route('calculator.loan') }}">再計算する</a>
</div>
@endsection
