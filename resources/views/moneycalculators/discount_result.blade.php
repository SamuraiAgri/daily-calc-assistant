@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>🏷️ 割引計算結果</h1>

    <!-- ビフォーアフター表示 -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin: 30px 0;">
        <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; border: 2px solid #ddd; text-align: center;">
            <div style="color: #999; font-size: 0.9em; margin-bottom: 8px;">元の金額</div>
            <div style="font-size: 2em; font-weight: bold; color: #666; text-decoration: line-through;">
                {{ number_format($amount, 0) }} 円
            </div>
        </div>
        
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #ed8936; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">割引後（税込）</div>
            <div style="font-size: 2.2em; font-weight: bold; color: #e53e3e;">
                {{ number_format($discountedAmountIncludingTax, 0) }} 円
            </div>
        </div>
    </div>

    <!-- 割引額の強調表示 -->
    <div style="background: #fff3cd; padding: 20px; border-radius: 12px; border-left: 5px solid #ffc107; margin: 20px 0;">
        <div style="text-align: center;">
            <div style="color: #856404; font-size: 0.95em; margin-bottom: 5px;">💰 お得になった金額</div>
            <div style="font-size: 2.5em; font-weight: bold; color: #ff6b6b;">
                {{ number_format($totalDiscount, 0) }} 円 OFF!
            </div>
        </div>
    </div>

    <!-- 詳細内訳 -->
    <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin: 30px 0;">
        <h3 style="margin-bottom: 20px;">📋 計算の詳細</h3>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 15px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="color: #666;">🏷️ 1回目の割引（{{ $discountRate1 }}%）</span>
                <span style="font-weight: bold; color: #f56565;">-{{ number_format($amount * $discountRate1 / 100, 0) }} 円</span>
            </div>
            @if($discountRate2 > 0)
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="color: #666;">🏷️ 2回目の割引（{{ $discountRate2 }}%）</span>
                <span style="font-weight: bold; color: #f56565;">-{{ number_format(($amount * (100 - $discountRate1) / 100) * $discountRate2 / 100, 0) }} 円</span>
            </div>
            @endif
            <div style="border-top: 2px dashed #ddd; padding-top: 10px; margin-top: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <span style="color: #666; font-weight: bold;">割引後（税抜）</span>
                    <span style="font-size: 1.2em; font-weight: bold; color: #4299e1;">{{ number_format($discountedAmount, 0) }} 円</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #666;">消費税（{{ $taxRate }}%）</span>
                    <span style="font-weight: bold; color: #666;">+{{ number_format($discountedAmountIncludingTax - $discountedAmount, 0) }} 円</span>
                </div>
            </div>
        </div>

        <div style="background: #fff; padding: 20px; border-radius: 8px; border: 3px solid #4299e1; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 5px;">最終価格（税込）</div>
            <div style="font-size: 2em; font-weight: bold; color: #2c5282;">{{ number_format($discountedAmountIncludingTax, 0) }} 円</div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('calculator.discount') }}" style="display: inline-block; padding: 15px 40px; background: #4299e1; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 1.1em;">
            🔄 再計算する
        </a>
    </div>
</div>
@endsection
