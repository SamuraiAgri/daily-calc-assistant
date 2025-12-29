@extends('layouts.app')

@section('title', '金融・計算用語集 - わかりやすい解説と具体例 | Daily Calc Assistant')
@section('description', 'ローン、積立、税金、年齢計算に関する専門用語をわかりやすく解説。具体例付きで、初心者でも理解しやすい用語集です。')
@section('keywords', '用語集,金融用語,計算用語,ローン用語,投資用語,税金用語,わかりやすい,解説')

@section('content')
<div class="content-container">
    <h1 style="text-align: center; margin-bottom: 20px;">📚 金融・計算用語集</h1>
    
    <p style="text-align: center; max-width: 800px; margin: 0 auto 40px; line-height: 1.8; color: #555;">
        ローン、積立、税金計算などで使われる専門用語をわかりやすく解説します。<br>
        具体例付きで、初心者の方でも理解しやすい内容です。
    </p>

    <!-- カテゴリーナビゲーション -->
    <div style="padding: 30px; border-radius: 10px; margin-bottom: 40px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 25px;">カテゴリーから探す</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px;">
            @foreach($categories as $catKey => $catInfo)
                <a href="{{ route('glossary.category', $catKey) }}" 
                   style="display: flex; align-items: center; justify-content: center; padding: 20px; 
                          border-radius: 8px; text-decoration: none; border: 2px solid #ddd;
                          font-weight: bold; transition: transform 0.2s;">
                    <span style="font-size: 1.5em; margin-right: 10px;">{{ $catInfo['icon'] }}</span>
                    <span>{{ $catInfo['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- 全用語一覧 -->
    <div>
        <h2 style="margin-bottom: 25px;">すべての用語</h2>
        
        @php
            $groupedTerms = [];
            foreach($terms as $term) {
                $firstChar = mb_substr($term['reading'], 0, 1);
                if (!isset($groupedTerms[$firstChar])) {
                    $groupedTerms[$firstChar] = [];
                }
                $groupedTerms[$firstChar][] = $term;
            }
            ksort($groupedTerms);
        @endphp

        @foreach($groupedTerms as $char => $termsList)
            <div style="margin-bottom: 40px;">
                <h3 style="padding: 10px 20px; border-radius: 5px; 
                           border: 2px solid #ddd; margin-bottom: 20px;">
                    {{ $char }}
                </h3>
                
                @foreach($termsList as $term)
                    <div style="padding: 25px; margin-bottom: 20px; 
                               border-radius: 8px; border: 2px solid #ddd;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                            <div>
                                <h4 style="margin-bottom: 5px; font-size: 1.3em;">
                                    {{ $term['term'] }}
                                </h4>
                                <p style="color: #666; font-size: 0.9em; margin-bottom: 10px;">
                                    読み：{{ $term['reading'] }}
                                </p>
                            </div>
                            <span style="padding: 5px 15px; border: 1px solid #ddd; border-radius: 20px; 
                                        font-size: 0.85em; white-space: nowrap;">
                                {{ $categories[$term['category']]['icon'] }} {{ $categories[$term['category']]['name'] }}
                            </span>
                        </div>
                        
                        <p style="line-height: 1.8; margin-bottom: 15px;">
                            {{ $term['description'] }}
                        </p>
                        
                        @if(!empty($term['example']))
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 15px;">
                                <p style="font-weight: bold; margin-bottom: 8px; font-size: 0.9em;">
                                    💡 具体例
                                </p>
                                <p style="line-height: 1.7; color: #555; font-size: 0.95em;">
                                    {{ $term['example'] }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- 関連リンク -->
    <div style="padding: 30px; border-radius: 10px; margin-top: 50px; border: 2px solid #ddd;">
        <h2 style="text-align: center; margin-bottom: 25px;">関連ページ</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <a href="{{ route('calculator.loan') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;">
                🏠 ローン計算
            </a>
            <a href="{{ route('calculator.savings') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;">
                💰 積立計算
            </a>
            <a href="{{ route('calculator.tax') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;">
                📊 税金計算
            </a>
            <a href="{{ route('blog.index') }}" 
               style="padding: 20px; border-radius: 8px; text-decoration: none; 
                      font-weight: bold; text-align: center; border: 2px solid #ddd;">
                📝 ブログ記事
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
