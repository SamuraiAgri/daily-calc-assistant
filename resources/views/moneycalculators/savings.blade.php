@extends('layouts.app')

@section('title', '積立計算 - 将来の貯蓄額をシミュレーション | Daily Calc Assistant')
@section('description', '毎月の積立額から将来の貯蓄総額を計算。満期一括課税・複利毎課税・ボーナス併用など、さまざまな積立パターンをシミュレーションできます。')
@section('keywords', '積立計算,貯金シミュレーション,複利計算,積立投資,将来価値計算,満期一括課税,複利毎課税')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>積立計算</h1>
        <p class="calculator-description">毎月の積み立て金額を入力して、将来の積み立て総額を計算します。<br>貯金や投資計画を立てる際に最適なツールです。</p>
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

    <h2>💰 基本の積立計算</h2>
    <p>毎月一定額を積み立てた場合、将来いくらになるかを計算します。</p>
    <form method="POST" action="{{ route('calculator.savings') }}">
        @csrf
        <label for="monthly_amount">毎月積立額（万円）</label>
        <input type="number" name="monthly_amount" id="monthly_amount" placeholder="5" value="{{ old('monthly_amount') }}" required><br>

        <label for="rate">年利率 (%)</label>
        <input type="number" name="rate" id="rate" placeholder="1.5" step="0.01" value="{{ old('rate') }}" required><br>

        <label for="years">積立期間 (年)</label>
        <input type="number" name="years" id="years" placeholder="10" value="{{ old('years') }}" required><br>

        <button type="submit">計算する</button>
    </form>

    <h2>🎁 ボーナス併用積立計算</h2>
    <p>毎月の積立に加え、ボーナス月（年2回）に追加で積み立てる場合の計算です。</p>
    <form method="POST" action="{{ route('calculator.savingsWithBonus') }}">
        @csrf
        <label for="bonus_monthly_amount">毎月積立額（万円）</label>
        <input type="number" name="monthly_amount" id="bonus_monthly_amount" placeholder="5" value="{{ old('monthly_amount') }}" required><br>

        <label for="bonus_amount">ボーナス積立額（万円）</label>
        <input type="number" name="bonus_amount" id="bonus_amount" placeholder="10" value="{{ old('bonus_amount') }}" required><br>

        <label for="bonus_rate">年利率 (%)</label>
        <input type="number" name="rate" id="bonus_rate" placeholder="1.5" step="0.01" value="{{ old('rate') }}" required><br>

        <label for="bonus_years">積立期間 (年)</label>
        <input type="number" name="years" id="bonus_years" placeholder="10" value="{{ old('years') }}" required><br>

        <button type="submit">計算する</button>
    </form>

    <!-- 詳細説明セクション -->
    <div class="info-section" style="margin-top: 50px;">
        <h2>積立計算ツールの使い方</h2>
        
        <div class="info-card">
            <h3>📊 このツールでできること</h3>
            <ul>
                <li>毎月の積立で将来いくらになるかシミュレーション</li>
                <li>複利効果を考慮した正確な計算</li>
                <li>ボーナス併用積立のシミュレーション</li>
                <li>元本、利息、税引後金額を一目で確認</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>💡 積立計算の仕組み</h3>
            <p>このツールは<strong>複利計算</strong>を行います。毎月の積立額に対して利息が複利で計算され、その利息にもまた利息がつきます。</p>
            <p style="background: #fff3cd; padding: 15px; border-radius: 8px; margin-top: 10px;">
                <strong>⚠️ 税金について：</strong>利息には約20.315%の税金（所得税15% + 住民税5% + 復興特別所得税0.315%）がかかります。ただし、NISA口座では税金がかかりません。
            </p>
        </div>

        <div class="info-card">
            <h3>📈 複利効果とは</h3>
            <p>複利とは「利息が利息を生む」仕組みです。例えば100万円を年利3%で運用すると：</p>
            <ul>
                <li><strong>1年目：</strong>100万円 × 1.03 = 103万円（利息3万円）</li>
                <li><strong>2年目：</strong>103万円 × 1.03 = 106.09万円（利息3.09万円）</li>
                <li><strong>10年目：</strong>約134万円（総利息34万円）</li>
            </ul>
            <p>時間が長いほど、複利効果は大きくなります。</p>
        </div>

        <div class="info-card">
            <h3>💰 実践的な活用例</h3>
            
            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例1：教育資金の準備</h4>
                <p><strong>目標：</strong>子どもの大学資金500万円を18年間で準備</p>
                <p><strong>条件：</strong></p>
                <ul style="line-height: 1.8;">
                    <li>毎月積立額：2万円</li>
                    <li>年利率：3%</li>
                    <li>積立期間：18年</li>
                </ul>
                <p><strong>結果：</strong>約563万円（元本432万円 + 利益131万円）</p>
            </div>

            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例2：老後資金の積立</h4>
                <p><strong>目標：</strong>老後資金2000万円を30年間で準備</p>
                <p><strong>条件：</strong></p>
                <ul style="line-height: 1.8;">
                    <li>毎月積立額：3万円</li>
                    <li>ボーナス積立：年2回、各10万円</li>
                    <li>年利率：4%</li>
                    <li>積立期間：30年</li>
                </ul>
                <p><strong>結果：</strong>約3,488万円（元本1,680万円 + 利益1,808万円）</p>
            </div>

            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例3：短期的な貯蓄目標</h4>
                <p><strong>目標：</strong>車の購入資金300万円を5年間で準備</p>
                <p><strong>条件：</strong></p>
                <ul style="line-height: 1.8;">
                    <li>毎月積立額：4.8万円</li>
                    <li>年利率：1%</li>
                    <li>積立期間：5年</li>
                </ul>
                <p><strong>結果：</strong>約295万円（利率が低いため、ほぼ元本のみ）</p>
            </div>
        </div>

        <div class="info-card">
            <h3>⚠️ 積立を始める前に知っておくべきこと</h3>
            <ul>
                <li><strong>利率の現実性：</strong>日本の銀行預金は年0.001%程度。高い利回りを狙うなら投資信託やNISAを検討</li>
                <li><strong>税金：</strong>利息には約20%の税金がかかる（NISA口座除く）</li>
                <li><strong>インフレ：</strong>物価上昇率を考慮すると、実質的な価値は目減りする可能性がある</li>
                <li><strong>継続の重要性：</strong>途中で止めると複利効果が半減。自動引き落としがおすすめ</li>
                <li><strong>緊急時の備え：</strong>積立とは別に、生活費3〜6ヶ月分の現金を確保しておく</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>🎯 目標金額から逆算する方法</h3>
            <p>「〇〇万円貯めたい」という目標がある場合、必要な月々の積立額を計算できます。</p>
            <p><strong>簡易計算式：</strong></p>
            <p>月々の積立額 ≒ 目標金額 ÷（期間（月）×（1 + 利率/2））</p>
            <p><strong>例：</strong>1000万円を20年間（240ヶ月）、年利3%で貯める場合</p>
            <p>月々の積立額 ≒ 1000万円 ÷（240 ×（1 + 0.03/2））= 約3.1万円</p>
        </div>

        <div class="info-card">
            <h3>🔄 72の法則</h3>
            <p>資産が2倍になるまでの期間を簡単に計算できる法則です。</p>
            <p><strong>72 ÷ 年利率（%）= 資産が2倍になる年数</strong></p>
            <ul>
                <li>年利1%：72年で2倍</li>
                <li>年利3%：24年で2倍</li>
                <li>年利6%：12年で2倍</li>
                <li>年利10%：7.2年で2倍</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>❓ よくある質問（FAQ）</h3>
            
            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q1. ボーナス積立とは何ですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 毎月の積立に加えて、ボーナス月（通常年2回）に追加で積み立てる方式です。毎月の負担を軽くしながら、年間の積立額を増やせます。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q2. 実際の金融商品の利率はどのくらいですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 2024年時点で、銀行普通預金は年0.001%、定期預金は年0.002〜0.2%程度です。投資信託の期待リターンは年3〜7%ですが、元本保証はありません。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q3. NISAとつみたてNISAはどう違いますか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 2024年から新NISAに統合されました。年間360万円まで非課税で投資でき、運用益に税金がかかりません。長期の資産形成に最適です。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q4. 途中で積立額を変更できますか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 多くの金融商品では変更可能です。ただし、商品によって条件が異なるため、契約前に確認しましょう。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q5. 元本割れのリスクはありますか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 銀行預金は元本保証ですが、投資信託や株式は元本割れのリスクがあります。リスクとリターンのバランスを考えて選びましょう。</p>
            </div>
        </div>

        <div class="info-card">
            <h3>🔗 関連ツール・記事</h3>
            <div class="related-links" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="{{ route('calculator.loan') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">ローン計算</a>
                <a href="{{ route('calculator.interest') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">利息計算</a>
                <a href="{{ route('blog.show', 'savings-compound-interest') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">複利効果の記事</a>
                <a href="{{ route('blog.show', 'retirement-savings-calculator') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">老後資金の記事</a>
            </div>
        </div>
    </div>
@endsection
