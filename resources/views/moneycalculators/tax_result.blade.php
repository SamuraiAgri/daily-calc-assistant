@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>🧾 消費税計算結果</h1>

    <!-- 計算フロー図 -->
    <div style="background: #fff; padding: 30px; border-radius: 12px; border: 3px solid #ed8936; margin: 30px 0; text-align: center;">
        <div style="color: #666; font-size: 0.9em; margin-bottom: 15px;">税込金額（お支払い総額）</div>
        <div style="font-size: 2.5em; font-weight: bold; color: #e53e3e; margin-bottom: 10px;">
            {{ number_format($amountIncludingTax, 0) }} 円
        </div>
        <div style="color: #666; font-size: 0.9em;">消費税率 {{ $taxRate }}% 適用</div>
    </div>

    <!-- 内訳表示 -->
    <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin: 30px 0;">
        <h3 style="margin-bottom: 20px; text-align: center;">📊 金額の内訳</h3>
        
        @php
            $taxPercent = ($taxAmount / $amountIncludingTax) * 100;
            $basePercent = 100 - $taxPercent;
        @endphp
        
        <div style="display: flex; height: 50px; border-radius: 8px; overflow: hidden; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <div style="background: #4299e1; width: {{ $basePercent }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.1em;">
                税抜 {{ number_format($basePercent, 1) }}%
            </div>
            <div style="background: #f56565; width: {{ $taxPercent }}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.1em;">
                税 {{ number_format($taxPercent, 1) }}%
            </div>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; gap: 15px; flex-wrap: wrap;">
            <div style="background: white; padding: 20px; border-radius: 10px; border: 3px solid #4299e1; text-align: center; min-width: 200px;">
                <div style="color: #666; font-size: 0.85em; margin-bottom: 8px;">税抜金額</div>
                <div style="font-size: 1.6em; font-weight: bold; color: #4299e1;">
                    {{ number_format($amountExcludingTax, 0) }} 円
                </div>
            </div>
            
            <div style="font-size: 2em; color: #999;">+</div>
            
            <div style="background: white; padding: 20px; border-radius: 10px; border: 3px solid #f56565; text-align: center; min-width: 200px;">
                <div style="color: #666; font-size: 0.85em; margin-bottom: 8px;">消費税額（{{ $taxRate }}%）</div>
                <div style="font-size: 1.6em; font-weight: bold; color: #f56565;">
                    {{ number_format($taxAmount, 0) }} 円
                </div>
            </div>
            
            <div style="font-size: 2em; color: #999;">=</div>
            
            <div style="background: white; padding: 20px; border-radius: 10px; border: 3px solid #ed8936; text-align: center; min-width: 200px;">
                <div style="color: #666; font-size: 0.85em; margin-bottom: 8px;">税込金額</div>
                <div style="font-size: 1.6em; font-weight: bold; color: #ed8936;">
                    {{ number_format($amountIncludingTax, 0) }} 円
                </div>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('calculator.tax') }}" style="display: inline-block; padding: 15px 40px; background: #4299e1; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 1.1em;">
            🔄 再計算する
        </a>
    </div>
</div>
@endsection
