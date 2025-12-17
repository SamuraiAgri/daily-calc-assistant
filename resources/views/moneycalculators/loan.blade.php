@extends('layouts.app')

@section('title', 'ローン返済計算 - 住宅ローン・自動車ローンシミュレーション | Daily Calc Assistant')
@section('description', '住宅ローンや自動車ローンの返済額を簡単計算。元利均等返済・元金均等返済の比較、ボーナス併用返済のシミュレーションも可能。毎月の返済額と総返済額がわかります。')
@section('keywords', 'ローン計算,住宅ローン,自動車ローン,返済シミュレーション,元利均等返済,元金均等返済,ボーナス返済,毎月返済額')

@section('structured_data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebApplication",
    "name": "ローン返済計算ツール",
    "applicationCategory": "FinanceApplication",
    "operatingSystem": "All",
    "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "JPY"
    },
    "description": "住宅ローンや自動車ローンの返済額を計算するツール"
}
</script>
@endsection

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>ローン返済計算</h1>
        <p class="calculator-description">借入金額、利率、返済期間を入力して、ローンの返済額を計算します。<br>住宅ローンや自動車ローンのシミュレーションに最適です。</p>
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

    <form method="POST" action="{{ route('calculator.loan') }}">
        @csrf
        <label for="principal">借入金額（万円）</label>
        <input type="number" name="principal" id="principal" placeholder="300" value="{{ old('principal') }}" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="3.5" step="0.01" value="{{ old('rate') }}" required><br>

        <label for="years">返済期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="15" value="{{ old('years') }}" required><br>

        <label for="method">返済方法</label>
        <select name="method" id="method">
            <option value="fixed" {{ old('method') === 'fixed' ? 'selected' : '' }}>元利均等返済</option>
            <option value="principal" {{ old('method') === 'principal' ? 'selected' : '' }}>元金均等返済</option>
        </select><br>

        <button type="submit">毎月払いで計算</button>
    </form>

    <h2>ボーナス併用返済はこちら</h2>
    <p>ボーナス月に追加で返済を行い、総返済額や返済期間を調整します。<br>通常の返済に加えて、ボーナス払いを組み合わせたシミュレーションが可能です。</p>
        <form method="POST" action="{{ route('calculator.loanWithBonus') }}">
        @csrf
        <label for="bonus_principal">借入金額（万円）</label>
        <input type="number" name="principal" id="bonus_principal" placeholder="300" value="{{ old('principal') }}" required><br>

        <label for="bonus_rate">年利率 (%)</label>
        <input type="number" name="rate" id="bonus_rate" placeholder="3.5" step="0.01" value="{{ old('rate') }}" required><br>

        <label for="bonus_years">返済期間 (年)</label>
        <input type="number" name="years" id="bonus_years" placeholder="15" value="{{ old('years') }}" required><br>

        <label for="bonus">ボーナス返済額（万円）</label>
        <input type="number" name="bonus" id="bonus" placeholder="10" value="{{ old('bonus') }}" required><br>

        <label for="bonus_method">返済方法</label>
        <select name="method" id="bonus_method">
            <option value="fixed" {{ old('method') === 'fixed' ? 'selected' : '' }}>元利均等返済</option>
            <option value="principal" {{ old('method') === 'principal' ? 'selected' : '' }}>元金均等返済</option>
        </select><br>

        <button type="submit">ボーナス併用払いで計算</button>
    </form>

    <!-- 詳細説明セクション -->
    <div class="info-section">
        <h2>ローン計算の使い方</h2>
        
        <div class="info-card">
            <h3>📊 このツールでできること</h3>
            <ul>
                <li>毎月の返済額を簡単に計算</li>
                <li>元利均等返済と元金均等返済の比較</li>
                <li>ボーナス併用返済のシミュレーション</li>
                <li>総返済額の確認</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>💡 返済方法の違い</h3>
            <div class="comparison-table">
                <div class="comparison-row">
                    <div class="comparison-cell"><strong>元利均等返済</strong></div>
                    <div class="comparison-cell">毎月の返済額が一定で、計画が立てやすい</div>
                </div>
                <div class="comparison-row">
                    <div class="comparison-cell"><strong>元金均等返済</strong></div>
                    <div class="comparison-cell">最初は返済額が多いが、総返済額が少なくなる</div>
                </div>
            </div>
        </div>

        <div class="info-card">
            <h3>🏠 住宅ローンの基礎知識</h3>
            <p><strong>変動金利と固定金利：</strong></p>
            <ul>
                <li><strong>変動金利：</strong>市場金利に応じて見直される。初期金利は低めだが、将来の変動リスクがある</li>
                <li><strong>固定金利：</strong>借入時の金利が完済まで変わらない。返済計画が立てやすい</li>
            </ul>

            <p><strong>頭金について：</strong></p>
            <p>物件価格の20%程度の頭金を用意することで、借入額を減らし、総返済額を抑えることができます。</p>
        </div>

        <div class="info-card">
            <h3>⚠️ ローンを組む前に確認すること</h3>
            <ul>
                <li>年収に対する返済比率（一般的に年収の25%以内が目安）</li>
                <li>諸費用（登記費用、保証料、手数料など）</li>
                <li>団体信用生命保険の加入条件</li>
                <li>繰り上げ返済の手数料</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>📝 計算例</h3>
            <div class="example-box">
                <p><strong>条件：</strong></p>
                <ul>
                    <li>借入金額：3,000万円</li>
                    <li>年利率：1.5%</li>
                    <li>返済期間：35年</li>
                    <li>返済方法：元利均等返済</li>
                </ul>
                <p><strong>結果：</strong></p>
                <p>毎月の返済額：約91,855円<br>総返済額：約38,579,100円</p>
            </div>
        </div>

        <div class="info-card">
            <h3>🔗 関連ツール</h3>
            <div class="related-links">
                <a href="{{ route('calculator.savings') }}">積み立て計算</a>
                <a href="{{ route('calculator.interest') }}">利息計算</a>
                <a href="{{ route('blog.index') }}">お金に関する記事</a>
            </div>
        </div>
    </div>
</div>
@endsection
