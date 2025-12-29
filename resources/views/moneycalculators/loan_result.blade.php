@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>💰 ローン返済計算結果</h1>
    
    <!-- 重要情報の視覚的表示 -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 30px 0;">
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #4299e1; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">借入金額</div>
            <div style="font-size: 1.8em; font-weight: bold; color: #2c5282;">
                {{ number_format($loanAmount) }} 円
            </div>
        </div>
        
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #ed8936; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">支払総額</div>
            <div style="font-size: 1.8em; font-weight: bold; color: #e53e3e;">
                {{ number_format(ceil($totalPayment * 10000)) }} 円
            </div>
        </div>
        
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #f56565; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">支払利息合計</div>
            <div style="font-size: 1.8em; font-weight: bold; color: #e53e3e;">
                {{ number_format(ceil($totalInterest * 10000)) }} 円
            </div>
            <div style="color: #666; font-size: 0.85em; margin-top: 8px;">
                (借入額の {{ number_format(($totalInterest * 10000) / $loanAmount * 100, 1) }}%)
            </div>
        </div>
    </div>

    <!-- 元本と利息の視覚的な割合表示 -->
    <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin: 30px 0;">
        <h3 style="margin-bottom: 20px; text-align: center;">📊 支払総額の内訳</h3>
        <div style="display: flex; height: 40px; border-radius: 8px; overflow: hidden; margin-bottom: 20px;">
            @php
                $principalPercent = ($loanAmount / ceil($totalPayment * 10000)) * 100;
                $interestPercent = 100 - $principalPercent;
            @endphp
            <div style="background: #4299e1; width: {{ $principalPercent }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                元本 {{ number_format($principalPercent, 1) }}%
            </div>
            <div style="background: #f56565; width: {{ $interestPercent }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                利息 {{ number_format($interestPercent, 1) }}%
            </div>
        </div>
        <div style="display: flex; justify-content: space-around; text-align: center;">
            <div>
                <div style="color: #4299e1; font-size: 1.5em; font-weight: bold;">{{ number_format($loanAmount) }} 円</div>
                <div style="color: #666; font-size: 0.9em;">元本</div>
            </div>
            <div style="font-size: 2em; color: #ccc;">+</div>
            <div>
                <div style="color: #f56565; font-size: 1.5em; font-weight: bold;">{{ number_format(ceil($totalInterest * 10000)) }} 円</div>
                <div style="color: #666; font-size: 0.9em;">利息</div>
            </div>
            <div style="font-size: 2em; color: #ccc;">=</div>
            <div>
                <div style="color: #ed8936; font-size: 1.5em; font-weight: bold;">{{ number_format(ceil($totalPayment * 10000)) }} 円</div>
                <div style="color: #666; font-size: 0.9em;">支払総額</div>
            </div>
        </div>
    </div>

    <!-- 返済スケジュール -->
    <div style="background: #fff; padding: 25px; border-radius: 12px; border: 2px solid #ddd; margin: 30px 0;">
        <h2 style="margin-bottom: 20px;">📅 返済スケジュール</h2>
        
        @php
            $firstMonths = array_slice($schedule, 0, 6);
            $lastMonths = array_slice($schedule, -6);
            $middleCount = count($schedule) - 12;
        @endphp
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f0f4f8;">
                        <th style="padding: 12px; text-align: center; border: 1px solid #ddd;">回数</th>
                        <th style="padding: 12px; text-align: right; border: 1px solid #ddd;">返済額</th>
                        <th style="padding: 12px; text-align: right; border: 1px solid #ddd;">元本</th>
                        <th style="padding: 12px; text-align: right; border: 1px solid #ddd;">利息</th>
                        <th style="padding: 12px; text-align: right; border: 1px solid #ddd;">残高</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($firstMonths as $payment)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px; text-align: center; border: 1px solid #ddd;">{{ $payment['month'] }}回目</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd; font-weight: bold;">{{ number_format(ceil($payment['monthlyPayment'] * 10000)) }} 円</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd; color: #4299e1;">{{ number_format(ceil($payment['principalPayment'] * 10000)) }} 円</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd; color: #f56565;">{{ number_format(ceil($payment['interestPayment'] * 10000)) }} 円</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd;">{{ number_format(ceil($payment['remainingPrincipal'] * 10000)) }} 円</td>
                    </tr>
                    @endforeach
                    
                    @if($middleCount > 0)
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; background: #f8f9fa; border: 1px solid #ddd;">
                            <details style="cursor: pointer;">
                                <summary style="font-weight: bold; color: #4299e1;">
                                    ⬇️ {{ $middleCount }}回分のスケジュールを表示 ⬇️
                                </summary>
                                <table style="width: 100%; margin-top: 15px;">
                                    @foreach (array_slice($schedule, 6, $middleCount) as $payment)
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <td style="padding: 8px; text-align: center; width: 15%;">{{ $payment['month'] }}回目</td>
                                        <td style="padding: 8px; text-align: right; font-weight: bold; width: 20%;">{{ number_format(ceil($payment['monthlyPayment'] * 10000)) }} 円</td>
                                        <td style="padding: 8px; text-align: right; color: #4299e1; width: 20%;">{{ number_format(ceil($payment['principalPayment'] * 10000)) }} 円</td>
                                        <td style="padding: 8px; text-align: right; color: #f56565; width: 20%;">{{ number_format(ceil($payment['interestPayment'] * 10000)) }} 円</td>
                                        <td style="padding: 8px; text-align: right; width: 25%;">{{ number_format(ceil($payment['remainingPrincipal'] * 10000)) }} 円</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </details>
                        </td>
                    </tr>
                    @endif
                    
                    @foreach ($lastMonths as $payment)
                    <tr style="border-bottom: 1px solid #eee; {{ $loop->last ? 'background: #fff3cd;' : '' }}">
                        <td style="padding: 12px; text-align: center; border: 1px solid #ddd;">{{ $payment['month'] }}回目</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd; font-weight: bold;">{{ number_format(ceil($payment['monthlyPayment'] * 10000)) }} 円</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd; color: #4299e1;">{{ number_format(ceil($payment['principalPayment'] * 10000)) }} 円</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd; color: #f56565;">{{ number_format(ceil($payment['interestPayment'] * 10000)) }} 円</td>
                        <td style="padding: 12px; text-align: right; border: 1px solid #ddd;">{{ number_format(ceil($payment['remainingPrincipal'] * 10000)) }} 円</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p style="margin-top: 15px; color: #666; font-size: 0.9em;">
            💡 ヒント：最初は利息の割合が高く、返済が進むにつれて元本の割合が増えていきます。
        </p>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('calculator.loan') }}" style="display: inline-block; padding: 15px 40px; background: #4299e1; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 1.1em;">
            🔄 再計算する
        </a>
    </div>
</div>

<style>
details summary {
    list-style: none;
    padding: 10px;
    background: #e6f7ff;
    border-radius: 5px;
    transition: background 0.3s;
}
details summary:hover {
    background: #bae7ff;
}
details[open] summary {
    margin-bottom: 15px;
}
table {
    background: white;
}
</style>
@endsection
