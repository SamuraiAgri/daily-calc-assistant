@extends('layouts.app')

@section('title', $categoryName . 'の用語集 - Daily Calc Assistant')
@section('description', $categoryName . 'に関する専門用語をわかりやすく解説。具体例付きで初心者でも理解しやすい内容です。')

@section('content')
<div class="content-container">
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="margin-bottom: 10px;">
            {{ $categories[$category]['icon'] }} {{ $categoryName }}の用語集
        </h1>
        <p style="color: #555; line-height: 1.8;">
            {{ $categoryName }}に関連する用語を解説します
        </p>
    </div>

    <!-- パンくずリスト -->
    <div style="margin-bottom: 30px; font-size: 0.9em; color: #666;">
        <a href="{{ route('home') }}" style="color: #4299e1; text-decoration: none;">ホーム</a>
        <span style="margin: 0 8px;">></span>
        <a href="{{ route('glossary.index') }}" style="color: #4299e1; text-decoration: none;">用語集</a>
        <span style="margin: 0 8px;">></span>
        <span>{{ $categoryName }}</span>
    </div>

    <!-- カテゴリーナビゲーション -->
    <div style="padding: 20px; border-radius: 10px; margin-bottom: 40px; border: 2px solid #ddd;">
        <p style="font-weight: bold; margin-bottom: 15px;">他のカテゴリー：</p>
        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
            @foreach($categories as $catKey => $catInfo)
                @if($catKey !== $category)
                    <a href="{{ route('glossary.category', $catKey) }}" 
                       style="padding: 10px 20px; border-radius: 20px; 
                              text-decoration: none; font-size: 0.9em;
                              border: 2px solid #ddd; transition: all 0.2s;">
                        {{ $catInfo['icon'] }} {{ $catInfo['name'] }}
                    </a>
                @endif
            @endforeach
            <a href="{{ route('glossary.index') }}" 
               style="padding: 10px 20px; border-radius: 20px; 
                      text-decoration: none; font-size: 0.9em; font-weight: bold;
                      border: 2px solid #333; background: #333; color: white;">
                すべての用語を見る
            </a>
        </div>
    </div>

    <!-- 用語一覧 -->
    <div>
        @foreach($terms as $term)
            <div style="padding: 25px; margin-bottom: 20px; 
                       border-radius: 8px; border: 2px solid #ddd;">
                <div style="margin-bottom: 10px;">
                    <h2 style="margin-bottom: 5px; font-size: 1.4em;">
                        {{ $term['term'] }}
                    </h2>
                    <p style="color: #666; font-size: 0.9em;">
                        読み：{{ $term['reading'] }}
                    </p>
                </div>
                
                <p style="line-height: 1.8; margin-bottom: 15px; font-size: 1.05em;">
                    {{ $term['description'] }}
                </p>
                
                @if(!empty($term['example']))
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 15px;">
                        <p style="font-weight: bold; margin-bottom: 8px;">
                            💡 具体例
                        </p>
                        <p style="line-height: 1.7; color: #555;">
                            {{ $term['example'] }}
                        </p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- 関連ツール -->
    <div style="padding: 30px; border-radius: 10px; margin-top: 50px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 25px;">関連する計算ツール</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            @if($category === 'loan')
                <a href="{{ route('calculator.loan') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    ローン計算ツール
                </a>
                <a href="{{ route('calculator.interest') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    利息計算ツール
                </a>
            @elseif($category === 'savings')
                <a href="{{ route('calculator.savings') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    積立計算ツール
                </a>
                <a href="{{ route('calculator.interest') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    利息計算ツール
                </a>
            @elseif($category === 'tax')
                <a href="{{ route('calculator.tax') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    税金計算ツール
                </a>
                <a href="{{ route('calculator.discount') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    割引計算ツール
                </a>
            @elseif($category === 'date')
                <a href="{{ route('datecalculator.age') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    年齢計算ツール
                </a>
                <a href="{{ route('datecalculator.schoolYears') }}" 
                   style="padding: 20px; border-radius: 8px; text-decoration: none; 
                          font-weight: bold; text-align: center; border: 2px solid #ddd;">
                    入学卒業年計算
                </a>
            @endif
            <a href="{{ route('blog.index') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;">
                関連記事を読む
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
