@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>💰 積立計算結果</h1>
    
    <!-- 重要情報の視覚的表示 -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 30px 0;">
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #4299e1; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">最終積立額（税引後）</div>
            <div style="font-size: 2em; font-weight: bold; color: #2c5282;">
                {{ number_format($futureValueAfterTax ?? $finalFutureValueAfterTax, 2) }} 万円
            </div>
        </div>
        
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #48bb78; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">利息合計</div>
            <div style="font-size: 1.8em; font-weight: bold; color: #48bb78;">
                {{ number_format($interest ?? $totalInterest, 2) }} 万円
            </div>
        </div>
        
        @if(isset($taxAmount))
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #f56565; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">課税額（20%）</div>
            <div style="font-size: 1.8em; font-weight: bold; color: #f56565;">
                {{ number_format($taxAmount, 2) }} 万円
            </div>
        </div>
        @endif
    </div>

    <!-- 積立の内訳視覚化 -->
    <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin: 30px 0;">
        <h3 style="margin-bottom: 20px; text-align: center;">📊 積立額の内訳</h3>
        @php
            $finalAmount = $futureValueAfterTax ?? $finalFutureValueAfterTax;
            $interestAmount = $interest ?? $totalInterest;
            $principalAmount = $finalAmount - $interestAmount;
            $principalPercent = ($principalAmount / $finalAmount) * 100;
            $interestPercent = ($interestAmount / $finalAmount) * 100;
        @endphp
        <div style="display: flex; height: 40px; border-radius: 8px; overflow: hidden; margin-bottom: 20px;">
            <div style="background: #4299e1; width: {{ $principalPercent }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                元本 {{ number_format($principalPercent, 1) }}%
            </div>
            <div style="background: #48bb78; width: {{ $interestPercent }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                利息 {{ number_format($interestPercent, 1) }}%
            </div>
        </div>
        <div style="display: flex; justify-content: space-around; text-align: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <div style="color: #4299e1; font-size: 1.5em; font-weight: bold;">{{ number_format($principalAmount, 2) }} 万円</div>
                <div style="color: #666; font-size: 0.9em;">元本（積立額）</div>
            </div>
            <div style="font-size: 2em; color: #ccc;">+</div>
            <div>
                <div style="color: #48bb78; font-size: 1.5em; font-weight: bold;">{{ number_format($interestAmount, 2) }} 万円</div>
                <div style="color: #666; font-size: 0.9em;">利息</div>
            </div>
            <div style="font-size: 2em; color: #ccc;">=</div>
            <div>
                <div style="color: #667eea; font-size: 1.5em; font-weight: bold;">{{ number_format($finalAmount, 2) }} 万円</div>
                <div style="color: #666; font-size: 0.9em;">最終積立額</div>
            </div>
        </div>
        <p style="margin-top: 20px; color: #666; text-align: center; font-size: 0.95em;">
            💡 利息により元本が <strong style="color: #48bb78;">{{ number_format(($interestAmount / $principalAmount) * 100, 1) }}%</strong> 増加しました！
        </p>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('calculator.savings') }}" style="display: inline-block; padding: 15px 40px; background: #4299e1; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 1.1em;">
            🔄 再計算する
        </a>
    </div>
</div>
@endsection
