@extends('layouts.app')

@section('title', '消費税計算 - 税込・税抜価格を簡単計算 | Daily Calc Assistant')
@section('description', '消費税の計算を簡単に。税込価格から税抜価格、税抜価格から税込価格への変換が可能。端数処理も四捨五入・切り捨て・切り上げから選択できます。')
@section('keywords', '消費税計算,税込計算,税抜計算,消費税8%,消費税10%,税金計算')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>消費税計算</h1>
        <p class="calculator-description">指定した金額に対して税金を計算します。<br>日本の消費税率に基づいて簡単に計算でき、税抜きや税込み価格を確認するのに便利です。</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <form method="POST" action="{{ route('calculator.tax') }}">
        @csrf
        <label for="amount">金額</label>
        <input type="number" name="amount" id="amount" placeholder="100" required><br>

        <label for="unit">単位</label>
        <input type="radio" name="unit" value="yen" checked> 円
        <input type="radio" name="unit" value="man"> 万円<br>

        <label for="tax_rate">消費税率 (%)</label>
        <input type="number" name="tax_rate" id="tax_rate" placeholder="10" step="0.01" required><br>

        <label for="type">金額の種類</label>
        <select name="type" id="type">
            <option value="tax_excluded">税抜金額</option>
            <option value="tax_included">税込金額</option>
        </select><br>

        <label for="rounding">端数処理</label>
        <select name="rounding" id="rounding">
            <option value="round">四捨五入</option>
            <option value="floor">切り捨て</option>
            <option value="ceil">切り上げ</option>
        </select><br>

        <button type="submit">計算</button>
    </form>

    <!-- 詳細説明セクション -->
    <div class="info-section" style="margin-top: 50px;">
        <h2>消費税計算ツールの使い方</h2>
        
        <div class="info-card">
            <h3>📊 このツールでできること</h3>
            <ul>
                <li>税抜価格から税込価格への変換</li>
                <li>税込価格から税抜価格への変換</li>
                <li>軽減税率8%と標準税率10%の両方に対応</li>
                <li>端数処理（四捨五入・切り捨て・切り上げ）の選択</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>💡 消費税の基礎知識</h3>
            <p>日本の消費税は2019年10月から複数税率制度が導入されています。</p>
            
            <div style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px;">
                <h4 style="margin-bottom: 10px;">標準税率（10%）</h4>
                <ul style="line-height: 1.8;">
                    <li>ほとんどの商品・サービス</li>
                    <li>外食（店内飲食）</li>
                    <li>酒類</li>
                    <li>ケータリング・出張料理</li>
                </ul>
            </div>

            <div style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px;">
                <h4 style="margin-bottom: 10px;">軽減税率（8%）</h4>
                <ul style="line-height: 1.8;">
                    <li>飲食料品（酒類・外食を除く）</li>
                    <li>テイクアウト・宅配</li>
                    <li>週2回以上発行される新聞（定期購読契約）</li>
                </ul>
            </div>
        </div>

        <div class="info-card">
            <h3>🧮 計算式</h3>
            
            <div style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">税抜価格から税込価格を計算</h4>
                <p style="font-size: 1.1em; padding: 10px; background: white; border-radius: 5px;">
                    <strong>税込価格 = 税抜価格 × (1 + 税率)</strong>
                </p>
                <p><strong>例：</strong>税抜1,000円の商品（標準税率 10%）</p>
                <p>税込価格 = 1,000円 × 1.10 = 1,100円</p>
            </div>

            <div style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">税込価格から税抜価格を計算</h4>
                <p style="font-size: 1.1em; padding: 10px; background: white; border-radius: 5px;">
                    <strong>税抜価格 = 税込価格 ÷ (1 + 税率)</strong>
                </p>
                <p><strong>例：</strong>税込1,100円の商品（標準税率10%）</p>
                <p>税抜価格 = 1,100円 ÷ 1.10 = 1,000円</p>
            </div>
        </div>

        <div class="info-card">
            <h3>💰 実践的な活用例</h3>
            
            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例1：レストランでの会計</h4>
                <p><strong>状況：</strong>メニューには税抜価格が表示されている</p>
                <ul style="line-height: 1.8;">
                    <li>ランチセット：税抜980円</li>
                    <li>ドリンク：税抜300円</li>
                    <li>デザート：税抜420円</li>
                </ul>
                <p><strong>計算：</strong></p>
                <p>合計税抜：1,700円<br>
                消費税（10%）：170円<br>
                <strong>支払額：1,870円</strong></p>
            </div>

            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例2：スーパーでの買い物（軽減税率）</h4>
                <p><strong>状況：</strong>食料品の買い物</p>
                <ul style="line-height: 1.8;">
                    <li>野菜：税抜500円（8%）</li>
                    <li>肉：税抜1,200円（8%）</li>
                    <li>調味料：税抜300円（8%）</li>
                    <li>洗剤：税抜400円（10%）</li>
                </ul>
                <p><strong>計算：</strong></p>
                <p>食料品合計：2,000円 × 1.08 = 2,160円<br>
                日用品：400円 × 1.10 = 440円<br>
                <strong>支払額：2,600円</strong></p>
            </div>

            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例3：事業者の請求書作成</h4>
                <p><strong>状況：</strong>サービス料金の請求</p>
                <p>コンサルティング料：税抜50,000円</p>
                <p><strong>計算：</strong></p>
                <p>消費税（10%）：5,000円<br>
                <strong>請求額：55,000円</strong></p>
            </div>
        </div>

        <div class="info-card">
            <h3>⚠️ 判断が難しいケース</h3>
            
            <div style="margin-bottom: 20px; padding: 15px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                <h4 style="color: #856404; margin-bottom: 10px;">🍔 ファストフード・コンビニ</h4>
                <ul style="line-height: 1.8;">
                    <li><strong>店内飲食：</strong>10%（椅子・テーブルで提供）</li>
                    <li><strong>テイクアウト：</strong>8%（持ち帰り）</li>
                    <li><strong>注意：</strong>購入時に決定。後から変更不可</li>
                </ul>
            </div>

            <div style="margin-bottom: 20px; padding: 15px; background: #d1ecf1; border-radius: 8px; border-left: 4px solid #17a2b8;">
                <h4 style="color: #0c5460; margin-bottom: 10px;">🍱 宅配・出前</h4>
                <ul style="line-height: 1.8;">
                    <li><strong>単なる配達：</strong>8%（調理された食品の配送）</li>
                    <li><strong>ケータリング：</strong>10%（サービス提供を含む）</li>
                </ul>
            </div>

            <div style="margin-bottom: 20px; padding: 15px; background: #f8d7da; border-radius: 8px; border-left: 4px solid #dc3545;">
                <h4 style="color: #721c24; margin-bottom: 10px;">📰 新聞</h4>
                <ul style="line-height: 1.8;">
                    <li><strong>定期購読：</strong>8%（週2回以上発行）</li>
                    <li><strong>駅売り・コンビニ：</strong>10%</li>
                </ul>
            </div>
        </div>

        <div class="info-card">
            <h3>❓ よくある質問（FAQ）</h3>
            
            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q1. 端数処理はどうすればいいですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 法律上の決まりはありません。多くの店舗では「四捨五入」または「切り捨て」を採用しています。事業者の場合は、統一したルールを決めておきましょう。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q2. インボイス制度とは何ですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 2023年10月から始まった制度で、適格請求書（インボイス）の発行・保存が仕入税額控除の要件となりました。事業者間取引で重要です。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q3. 消費税は誰が払っていますか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 消費者が負担し、事業者が国に納付します。事業者は売上に含まれる消費税から、仕入れに含まれる消費税を差し引いた額を納税します。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q4. 海外から購入した場合の消費税は？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 個人輸入の場合、商品価格の60%が課税対象となり、16,666円を超えると消費税と関税がかかります。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q5. 非課税取引とは何ですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 土地の売買、住宅の貸付け、医療、学校の授業料など、消費税がかからない取引があります。軽減税率とは異なります。</p>
            </div>
        </div>

        <div class="info-card">
            <h3>💼 事業者向けポイント</h3>
            <ul>
                <li><strong>総額表示義務：</strong>消費者向け価格表示は税込が原則</li>
                <li><strong>仕入税額控除：</strong>適格請求書の保存が必要</li>
                <li><strong>簡易課税制度：</strong>小規模事業者向けの簡略化された計算方法</li>
                <li><strong>免税事業者：</strong>年間課税売上1,000万円以下は納税義務なし（インボイス制度で影響あり）</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>🔗 関連ツール・記事</h3>
            <div class="related-links" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="{{ route('calculator.discount') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">割引計算</a>
                <a href="{{ route('calculator.splitBill') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">割り勘計算</a>
                <a href="{{ route('blog.show', 'consumption-tax-calculation') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">消費税の記事</a>
                <a href="{{ route('blog.index') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">ブログ記事一覧</a>
            </div>
        </div>
    </div>
@endsection
