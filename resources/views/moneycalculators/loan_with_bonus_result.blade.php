@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>ローン返済計算結果（ボーナス併用）</h1>
    <p>支払総額 <strong>{{ number_format($totalPayment, 2) }} 円</strong></p>
    <p>支払利息合計 <strong>{{ number_format($totalInterest, 2) }} 円</strong></p>
    <h2>返済スケジュール</h2>
    <table>
        <tr>
            <th>月</th>
            <th>毎月の支払額</th>
            <th>元本</th>
            <th>利息</th>
            <th>残高</th>
        </tr>
        @foreach($schedule as $payment)
            <tr>
                <td>{{ $payment['month'] }}</td>
                <td>{{ number_format($payment['monthlyPayment'], 2) }} 円</td>
                <td>{{ number_format($payment['principalPayment'], 2) }} 円</td>
                <td>{{ number_format($payment['interestPayment'], 2) }} 円</td>
                <td>{{ number_format($payment['remainingPrincipal'], 2) }} 円</td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('calculator.loan') }}">再計算する</a>
</div>
@endsection
