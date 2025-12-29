@extends('layouts.app')

@section('title', 'ライフイベント別お金のガイド - Daily Calc Assistant')
@section('description', '結婚、出産、住宅購入、教育、老後など人生の重要なイベントに必要な費用と準備方法を詳しく解説。計算ツールと合わせて活用できます。')

@section('content')
<div class="content-container">
    <h1 style="text-align: center; margin-bottom: 20px;">🌟 ライフイベント別お金のガイド</h1>
    
    <p style="text-align: center; max-width: 800px; margin: 0 auto 50px; line-height: 1.8; color: #555;">
        人生の大きなイベントには、それぞれ多くの費用がかかります。<br>
        必要な金額と準備の流れを把握し、計画的に準備しましょう。
    </p>

    <!-- ライフイベント一覧 -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; margin-bottom: 50px;">
        @foreach($events as $event)
            <a href="{{ route('life-events.show', $event['slug']) }}" 
               style="display: block; padding: 30px; border-radius: 12px; 
                      text-decoration: none; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                <div style="font-size: 3em; text-align: center; margin-bottom: 15px;">
                    {{ $event['icon'] }}
                </div>
                <h2 style="text-align: center; margin-bottom: 15px; font-size: 1.5em;">
                    {{ $event['title'] }}
                </h2>
                <p style="color: #666; line-height: 1.7; margin-bottom: 15px; text-align: center;">
                    {{ $event['description'] }}
                </p>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
                    <p style="font-size: 0.9em; margin-bottom: 5px;">
                        <strong>💰 必要費用の目安</strong>
                    </p>
                    <p style="color: #555; font-size: 1.1em; font-weight: bold;">
                        {{ $event['estimated_cost'] }}
                    </p>
                </div>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                    <p style="font-size: 0.9em; margin-bottom: 5px;">
                        <strong>⏰ 準備期間</strong>
                    </p>
                    <p style="color: #555;">
                        {{ $event['timeline'] }}
                    </p>
                </div>
                <div style="text-align: center; margin-top: 20px; font-weight: bold;">
                    詳しく見る →
                </div>
            </a>
        @endforeach
    </div>

    <!-- ライフプラン作成のすすめ -->
    <div style="padding: 50px 30px; border-radius: 15px; margin-bottom: 50px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 25px; font-size: 1.8em;">
            💡 ライフプランを作成しましょう
        </h2>
        <p style="text-align: center; max-width: 700px; margin: 0 auto 30px; line-height: 1.8; font-size: 1.1em;">
            これらのライフイベントを時系列で整理し、必要な資金と準備方法を明確にすることで、
            安心して人生の各ステージを迎えることができます。
        </p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 30px;">
            <div style="text-align: center; padding: 20px;">
                <div style="font-size: 2.5em; margin-bottom: 10px;">📝</div>
                <h3 style="margin-bottom: 10px;">計画を立てる</h3>
                <p style="font-size: 0.95em;">いつ、何にいくら必要かを整理</p>
            </div>
            <div style="text-align: center; padding: 20px;">
                <div style="font-size: 2.5em; margin-bottom: 10px;">💰</div>
                <h3 style="margin-bottom: 10px;">資金を準備</h3>
                <p style="font-size: 0.95em;">積立や投資で計画的に貯蓄</p>
            </div>
            <div style="text-align: center; padding: 20px;">
                <div style="font-size: 2.5em; margin-bottom: 10px;">🔄</div>
                <h3 style="margin-bottom: 10px;">定期的に見直し</h3>
                <p style="font-size: 0.95em;">状況に応じて計画を調整</p>
            </div>
        </div>
    </div>

    <!-- 関連ツール -->
    <div style="padding: 40px 30px; border-radius: 12px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 30px;">
            便利な計算ツール
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
            <a href="{{ route('calculator.savings') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                💰 積立計算
            </a>
            <a href="{{ route('calculator.loan') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                🏠 ローン計算
            </a>
            <a href="{{ route('datecalculator.schoolYears') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                🎓 入学卒業年計算
            </a>
            <a href="{{ route('datecalculator.age') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                📅 年齢計算
            </a>
        </div>
    </div>
</div>

<style>
a:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}
</style>
@endsection
