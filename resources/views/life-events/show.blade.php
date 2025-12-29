@extends('layouts.app')

@section('title', $event['title'] . 'のお金ガイド - ライフイベント別計算 | Daily Calc Assistant')
@section('description', $event['description'] . '。必要な費用、準備の流れ、活用できる計算ツールを詳しく解説します。')

@section('content')
<div class="content-container">
    <!-- パンくずリスト -->
    <div style="margin-bottom: 20px; font-size: 0.9em; color: #666;">
        <a href="{{ route('home') }}" style="color: #4299e1; text-decoration: none;">ホーム</a>
        <span style="margin: 0 8px;">></span>
        <a href="{{ route('life-events.index') }}" style="color: #4299e1; text-decoration: none;">ライフイベントガイド</a>
        <span style="margin: 0 8px;">></span>
        <span>{{ $event['title'] }}</span>
    </div>

    <!-- ヘッダー -->
    <div style="text-align: center; margin-bottom: 40px;">
        <div style="font-size: 4em; margin-bottom: 15px;">{{ $event['icon'] }}</div>
        <h1 style="margin-bottom: 15px;">{{ $event['title'] }}のお金ガイド</h1>
        <p style="color: #555; line-height: 1.8; max-width: 700px; margin: 0 auto;">
            {{ $event['content']['overview'] }}
        </p>
    </div>

    <!-- 概要カード -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 50px;">
        <div style="padding: 30px; border-radius: 12px; text-align: center; border: 2px solid #ddd;">
            <div style="font-size: 2em; margin-bottom: 10px;">💰</div>
            <h3 style="margin-bottom: 10px; font-size: 1.1em;">必要費用の目安</h3>
            <p style="font-size: 1.3em; font-weight: bold;">{{ $event['estimated_cost'] }}</p>
        </div>
        <div style="padding: 30px; border-radius: 12px; text-align: center; border: 2px solid #ddd;">
            <div style="font-size: 2em; margin-bottom: 10px;">⏰</div>
            <h3 style="margin-bottom: 10px; font-size: 1.1em;">準備期間</h3>
            <p style="font-size: 1.3em; font-weight: bold;">{{ $event['timeline'] }}</p>
        </div>
    </div>

    <!-- 費用の詳細 -->
    <div style="margin-bottom: 50px;">
        <h2 style="margin-bottom: 25px; border-left: 5px solid #333; padding-left: 15px;">
            💵 必要な費用の内訳
        </h2>
        <div style="border-radius: 12px; overflow: hidden; border: 2px solid #ddd;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">項目</th>
                        <th style="padding: 15px; text-align: right;">金額の目安</th>
                        <th style="padding: 15px; text-align: left;">備考</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event['content']['costs'] as $index => $cost)
                        <tr style="{{ $index % 2 === 0 ? 'background: #f9f9f9;' : 'background: white;' }}">
                            <td style="padding: 15px; border-top: 1px solid #e2e8f0;">
                                <strong>{{ $cost['item'] }}</strong>
                            </td>
                            <td style="padding: 15px; text-align: right; border-top: 1px solid #e2e8f0; font-weight: bold;">
                                {{ $cost['amount'] }}
                            </td>
                            <td style="padding: 15px; border-top: 1px solid #e2e8f0; color: #666; font-size: 0.9em;">
                                {{ $cost['note'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 準備のタイムライン -->
    <div style="margin-bottom: 50px;">
        <h2 style="margin-bottom: 25px; border-left: 5px solid #333; padding-left: 15px;">
            📅 準備のタイムライン
        </h2>
        <div style="position: relative; padding-left: 40px;">
            <div style="position: absolute; left: 15px; top: 0; bottom: 0; width: 2px; background: #ddd;"></div>
            @foreach($event['content']['timeline'] as $period => $tasks)
                <div style="position: relative; margin-bottom: 30px;">
                    <div style="position: absolute; left: -32px; width: 24px; height: 24px; 
                               background: #333; border-radius: 50%; border: 3px solid white;
                               box-shadow: 0 0 0 2px #333;"></div>
                    <div style="padding: 20px; border-radius: 8px; border: 2px solid #ddd;">
                        <h3 style="margin-bottom: 15px; font-size: 1.2em;">
                            {{ $period }}
                        </h3>
                        <ul style="line-height: 2; color: #555; margin: 0; padding-left: 20px;">
                            @foreach($tasks as $task)
                                <li>{{ $task }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 役立つヒント -->
    <div style="margin-bottom: 50px;">
        <h2 style="margin-bottom: 25px; border-left: 5px solid #333; padding-left: 15px;">
            💡 役立つヒント
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            @foreach($event['content']['tips'] as $tip)
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; 
                           border: 2px solid #ddd; display: flex; align-items: start;">
                    <span style="font-size: 1.5em; margin-right: 12px;">✓</span>
                    <p style="line-height: 1.7; color: #555; margin: 0;">{{ $tip }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 活用できる計算ツール -->
    <div style="padding: 40px; border-radius: 15px; margin-bottom: 50px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 30px; font-size: 1.6em;">
            🧮 活用できる計算ツール
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
            @foreach($event['content']['calculations'] as $tool => $description)
                @php
                    $toolRoutes = [
                        'loan' => ['route' => 'calculator.loan', 'name' => 'ローン計算', 'icon' => '🏠'],
                        'savings' => ['route' => 'calculator.savings', 'name' => '積立計算', 'icon' => '💰'],
                        'tax' => ['route' => 'calculator.tax', 'name' => '税金計算', 'icon' => '📊'],
                        'school_years' => ['route' => 'datecalculator.schoolYears', 'name' => '入学卒業年計算', 'icon' => '🎓'],
                        'age' => ['route' => 'datecalculator.age', 'name' => '年齢計算', 'icon' => '📅'],
                        'split_bill' => ['route' => 'calculator.splitBill', 'name' => '割り勘計算', 'icon' => '💳'],
                    ];
                    $toolInfo = $toolRoutes[$tool] ?? null;
                @endphp
                @if($toolInfo)
                    <a href="{{ route($toolInfo['route']) }}" 
                       style="padding: 25px; border-radius: 10px; 
                              text-decoration: none; text-align: center;
                              border: 2px solid #ddd; transition: all 0.2s;">
                        <div style="font-size: 2.5em; margin-bottom: 10px;">{{ $toolInfo['icon'] }}</div>
                        <h3 style="margin-bottom: 10px; font-size: 1.1em;">{{ $toolInfo['name'] }}</h3>
                        <p style="font-size: 0.9em; line-height: 1.6; color: #666;">{{ $description }}</p>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <!-- 関連記事 -->
    <div style="padding: 30px; border-radius: 12px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 25px;">
            📝 関連記事
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
            <a href="{{ route('blog.index') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                お金の記事一覧
            </a>
            <a href="{{ route('glossary.index') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                用語集
            </a>
            <a href="{{ route('life-events.index') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;
                      transition: transform 0.2s;">
                他のライフイベント
            </a>
        </div>
    </div>
</div>

<style>
a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>
@endsection
