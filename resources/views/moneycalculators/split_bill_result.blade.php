@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>🍽️ 割り勘計算結果</h1>

    <!-- サマリー表示 -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 30px 0;">
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #4299e1; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">合計金額</div>
            <div style="font-size: 2em; font-weight: bold; color: #2c5282;">
                {{ number_format($totalAmount, 0) }} 円
            </div>
        </div>
        
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #48bb78; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">人数</div>
            <div style="font-size: 2em; font-weight: bold; color: #48bb78;">
                {{ $numPeople }} 人
            </div>
        </div>
        
        <div style="background: #fff; padding: 25px; border-radius: 12px; border: 3px solid #ed8936; text-align: center;">
            <div style="color: #666; font-size: 0.9em; margin-bottom: 8px;">1人あたり</div>
            <div style="font-size: 2em; font-weight: bold; color: #e53e3e;">
                {{ $adjustedAmounts[0] }} 円
            </div>
        </div>
    </div>

    <!-- 各人の支払額カード表示 -->
    <div style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin: 30px 0;">
        <h3 style="margin-bottom: 20px;">👥 各人の支払額</h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px;">
            @foreach ($adjustedAmounts as $index => $amount)
            <div style="background: white; padding: 20px; border-radius: 10px; border: 2px solid #e2e8f0; text-align: center; transition: all 0.3s;">
                <div style="color: #4299e1; font-size: 1.1em; font-weight: bold; margin-bottom: 8px;">
                    {{ $index + 1 }}人目
                </div>
                <div style="font-size: 1.6em; font-weight: bold; color: #2d3748;">
                    {{ $amount }} 円
                </div>
            </div>
            @endforeach
        </div>
        
        @if($numPeople > 1)
        <div style="background: #e6fffa; padding: 15px; border-radius: 8px; margin-top: 20px; text-align: center; border-left: 4px solid #38b2ac;">
            <p style="margin: 0; color: #234e52;">
                💡 全員が <strong style="color: #38b2ac;">{{ $adjustedAmounts[0] }} 円</strong> ずつ支払うと、合計 <strong style="color: #38b2ac;">{{ number_format($totalAmount, 0) }} 円</strong> になります
            </p>
        </div>
        @endif
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('calculator.splitBill') }}" style="display: inline-block; padding: 15px 40px; background: #4299e1; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 1.1em;">
            🔄 再計算する
        </a>
    </div>
</div>
@endsection
