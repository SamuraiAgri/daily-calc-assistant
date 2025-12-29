@extends('layouts.app')

@section('content')
    <!-- ヒーローセクション -->
    <section class="hero">
        <div class="hero-content">
            <h1 style="font-size: 2.5em; margin-bottom: 20px;">Daily Calc Assistant</h1>
            <p>シンプルで使いやすい計算ツールで、日々の生活をもっと便利に。</p>
            <div class="hero-buttons">
                <a href="#features" class="cta-button">計算を始める</a>
                <a href="{{ route('blog.index') }}" class="cta-button-secondary">ブログを読む</a>
            </div>
        </div>
    </section>

    <!-- サイト紹介セクション -->
    <section id="features" class="features">
        <div class="feature-list">
            <a href="{{ route('calculator.loan') }}" class="feature-item">
                <h3>ローン計算</h3>
                <p>借入金額、利率、返済期間を入力してローン返済額を計算します。</p>
            </a>
            <a href="{{ route('calculator.savings') }}" class="feature-item">
                <h3>積み立て計算</h3>
                <p>積み立て金額と利率から将来の貯金額を計算します。</p>
            </a>
            <a href="{{ route('calculator.interest') }}" class="feature-item">
                <h3>利息計算</h3>
                <p>元金と利率を使って利息を計算します。</p>
            </a>
            <a href="{{ route('calculator.splitBill') }}" class="feature-item">
                <h3>割り勘計算</h3>
                <p>合計金額を人数で割り勘計算します。</p>
            </a>
            <a href="{{ route('calculator.tax') }}" class="feature-item">
                <h3>税金計算</h3>
                <p>金額に対して消費税を計算します。</p>
            </a>
            <a href="{{ route('calculator.discount') }}" class="feature-item">
                <h3>割引計算</h3>
                <p>割引率を使って割引後の金額を計算します。</p>
            </a>
            <a href="{{ route('datecalculator.age') }}" class="feature-item">
                <h3>年齢計算</h3>
                <p>生年月日から現在の年齢を計算します。</p>
            </a>
            <a href="{{ route('datecalculator.schoolYears') }}" class="feature-item">
                <h3>入学卒業年計算</h3>
                <p>生年月日から学校の入学と卒業年を計算します。</p>
            </a>
            <a href="{{ route('datecalculator.daysSince') }}" class="feature-item">
                <h3>日数計算</h3>
                <p>特定の日から今日までの経過日数を計算します。</p>
            </a>
        </div>
    </section>

    <!-- お役立ちコンテンツセクション -->
    <section style="padding: 60px 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; font-size: 2em; margin-bottom: 40px;">お役立ちコンテンツ</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
                <!-- 用語集 -->
                <a href="{{ route('glossary.index') }}" 
                   style="display: block; padding: 30px; border-radius: 8px; 
                          text-decoration: none; border: 2px solid #ddd; transition: transform 0.2s;">
                    <div style="font-size: 3em; text-align: center; margin-bottom: 15px;">📚</div>
                    <h3 style="text-align: center; margin-bottom: 15px; font-size: 1.3em;">
                        金融・計算用語集
                    </h3>
                    <p style="line-height: 1.7; text-align: center;">
                        ローン、積立、税金などの専門用語を<br>わかりやすく解説します
                    </p>
                </a>

                <!-- ライフイベントガイド -->
                <a href="{{ route('life-events.index') }}" 
                   style="display: block; padding: 30px; border-radius: 8px; 
                          text-decoration: none; border: 2px solid #ddd; transition: transform 0.2s;">
                    <div style="font-size: 3em; text-align: center; margin-bottom: 15px;">🌟</div>
                    <h3 style="text-align: center; margin-bottom: 15px; font-size: 1.3em;">
                        ライフイベント別ガイド
                    </h3>
                    <p style="line-height: 1.7; text-align: center;">
                        結婚、出産、住宅購入など<br>人生のイベントに必要な費用を解説
                    </p>
                </a>

                <!-- ブログ -->
                <a href="{{ route('blog.index') }}" 
                   style="display: block; padding: 30px; border-radius: 8px; 
                          text-decoration: none; border: 2px solid #ddd; transition: transform 0.2s;">
                    <div style="font-size: 3em; text-align: center; margin-bottom: 15px;">📝</div>
                    <h3 style="text-align: center; margin-bottom: 15px; font-size: 1.3em;">
                        お金の知識ブログ
                    </h3>
                    <p style="line-height: 1.7; text-align: center;">
                        お金の計算方法や賢い使い方を<br>実例とともに詳しく解説
                    </p>
                </a>
            </div>
        </div>
    </section>

    <!-- サイトの特徴 -->
    <section style="padding: 60px 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; font-size: 2em; margin-bottom: 40px;">Daily Calc Assistantの特徴</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                <div style="text-align: center; padding: 30px; border: 2px solid #ddd; border-radius: 8px;">
                    <div style="font-size: 3em; margin-bottom: 15px;">✨</div>
                    <h3 style="margin-bottom: 15px;">完全無料</h3>
                    <p style="line-height: 1.7;">
                        すべての機能を無料でご利用いただけます。会員登録も不要です。
                    </p>
                </div>

                <div style="text-align: center; padding: 30px; border: 2px solid #ddd; border-radius: 8px;">
                    <div style="font-size: 3em; margin-bottom: 15px;">📱</div>
                    <h3 style="margin-bottom: 15px;">スマホ対応</h3>
                    <p style="line-height: 1.7;">
                        PC、タブレット、スマートフォンすべてのデバイスに最適化されています。
                    </p>
                </div>

                <div style="text-align: center; padding: 30px; border: 2px solid #ddd; border-radius: 8px;">
                    <div style="font-size: 3em; margin-bottom: 15px;">🔒</div>
                    <h3 style="margin-bottom: 15px;">プライバシー重視</h3>
                    <p style="line-height: 1.7;">
                        入力データは保存されません。安心してご利用ください。
                    </p>
                </div>

                <div style="text-align: center; padding: 30px; border: 2px solid #ddd; border-radius: 8px;">
                    <div style="font-size: 3em; margin-bottom: 15px;">⚡</div>
                    <h3 style="margin-bottom: 15px;">高速計算</h3>
                    <p style="line-height: 1.7;">
                        複雑な計算も瞬時に結果を表示。待ち時間はありません。
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
a:hover {
    transform: translateY(-3px);
}
</style>
