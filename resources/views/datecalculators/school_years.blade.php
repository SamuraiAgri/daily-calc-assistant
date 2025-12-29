@extends('layouts.app')

@section('title', '入学・卒業年計算 - 生年月日から学歴を計算 | Daily Calc Assistant')
@section('description', '生年月日から小学校・中学校・高校・大学の入学・卒業年を計算。日本の学校制度に対応し、早生まれも考慮した正確な計算が可能です。')
@section('keywords', '入学年計算,卒業年計算,学歴計算,早生まれ,小学校入学,中学校入学,高校入学,大学入学')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>入学・卒業年計算</h1>
        <p class="calculator-description">生年月日を入力して、中学校・高校・大学の入学および卒業年を計算します。<br>この計算ツールは、日本の学校制度に基づいており、教育計画を立てる際に便利です。</p>
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

    <form method="POST" action="{{ route('datecalculator.schoolYears') }}">
        @csrf
        <label for="birthdate">生年月日</label>
        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required><br>

        <button type="submit">計算</button>
    </form>

    <!-- 詳細説明セクション -->
    <div class="info-section" style="margin-top: 50px;">
        <h2>入学・卒業年計算の使い方</h2>
        
        <div class="info-card">
            <h3>📊 このツールでできること</h3>
            <ul>
                <li>生年月日から各学校の入学・卒業年を自動計算</li>
                <li>小学校、中学校、高校、大学の年度を一覧表示</li>
                <li>早生まれを考慮した正確な計算</li>
                <li>現在の学年の確認</li>
            </ul>
        </div>

        <div class="info-card">
            <h3>🎓 日本の学校制度</h3>
            <p>日本の学校は4月1日〜翌年3月31日が1年度です。学年は生年月日によって決まります。</p>
            
            <div style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px;">
                <h4 style="margin-bottom: 10px;">同じ学年になる生年月日の範囲</h4>
                <p style="font-size: 1.1em; padding: 15px; background: #fff; border-radius: 5px; border: 2px solid #ddd;">
                    <strong>〇〇年4月2日 ～ 翼年4月1日生まれ</strong>
                </p>
                <p style="margin-top: 15px; line-height: 1.8;">例：2018年4月2日〜2019年4月1日生まれは同じ学年</p>
            </div>

            <div style="background: #fff3cd; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">⚠️ なぜ4月2日から？</h4>
                <p style="line-height: 1.8;">法律上、年齢は誕生日の<strong>前日</strong>に加算されます。そのため：</p>
                <ul style="line-height: 1.8; margin-top: 10px;">
                    <li><strong>4月1日生まれ</strong> → 3月31日に年齢が上がる → 早生まれ扱い</li>
                    <li><strong>4月2日生まれ</strong> → 4月1日に年齢が上がる → 遅生まれ扱い</li>
                </ul>
            </div>
        </div>

        <div class="info-card">
            <h3>📅 各学校の期間</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px solid #ddd;">
                    <h4 style="margin-bottom: 10px;">小学校</h4>
                    <p style="line-height: 1.8;">
                        <strong>期間：</strong>6年間<br>
                        <strong>年齢：</strong>6歳〜12歳<br>
                        <strong>学年：</strong>1年生〜6年生
                    </p>
                </div>

                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px solid #ddd;">
                    <h4 style="margin-bottom: 10px;">中学校</h4>
                    <p style="line-height: 1.8;">
                        <strong>期間：</strong>3年間<br>
                        <strong>年齢：</strong>12歳〜15歳<br>
                        <strong>学年：</strong>1年生〜3年生
                    </p>
                </div>

                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px solid #ddd;">
                    <h4 style="margin-bottom: 10px;">高等学校</h4>
                    <p style="line-height: 1.8;">
                        <strong>期間：</strong>3年間<br>
                        <strong>年齢：</strong>15歳〜18歳<br>
                        <strong>学年：</strong>1年生〜3年生
                    </p>
                </div>

                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px solid #ddd;">
                    <h4 style="margin-bottom: 10px;">大学</h4>
                    <p style="line-height: 1.8;">
                        <strong>期間：</strong>4年間（一般的）<br>
                        <strong>年齢：</strong>18歳〜22歳<br>
                        <strong>学年：</strong>1年生〜4年生
                    </p>
                </div>
            </div>
        </div>

        <div class="info-card">
            <h3>💰 実践的な活用例</h3>
            
            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例1：教育資金の計画</h4>
                <p><strong>状況：</strong>2020年6月生まれの子どもの教育資金を準備したい</p>
                <p><strong>計算結果：</strong></p>
                <ul style="line-height: 1.8;">
                    <li>小学校入学：2027年4月（6年後）</li>
                    <li>中学校入学：2033年4月（12年後）</li>
                    <li>高校入学：2036年4月（15年後）</li>
                    <li>大学入学：2039年4月（18年後）</li>
                </ul>
                <p style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 5px; border: 2px solid #ddd;">
                    <strong>活用：</strong>18年後の大学入学費用500万円を目標に、今から積立計画を立てる
                </p>
            </div>

            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例2：兄弟の学年差を確認</h4>
                <p><strong>状況：</strong>長男（2018年5月生まれ）と次男（2020年3月生まれ）</p>
                <p><strong>計算結果：</strong></p>
                <ul style="line-height: 1.8;">
                    <li>長男小学校入学：2025年4月</li>
                    <li>次男小学校入学：2027年4月</li>
                    <li>学年差：2学年</li>
                </ul>
                <p style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 5px; border: 2px solid #ddd;">
                    <strong>活用：</strong>2025年と2027年に入学準備金が必要。重なる時期の教育費を計算
                </p>
            </div>

            <div class="example-box" style="background: #f8f9fa; padding: 20px; margin: 15px 0; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">例3：受験スケジュールの把握</h4>
                <p><strong>状況：</strong>2010年8月生まれの子どもの受験時期を確認</p>
                <p><strong>計算結果：</strong></p>
                <ul style="line-height: 1.8;">
                    <li>中学校入学：2023年4月（受験は2022年冬）</li>
                    <li>高校入学：2026年4月（受験は2026年冬）</li>
                    <li>大学入学：2029年4月（受験は2029年冬）</li>
                </ul>
            </div>
        </div>

        <div class="info-card">
            <h3>⚠️ 特殊なケースと注意点</h3>
            
            <div style="margin-bottom: 20px; padding: 15px; background: #fff3cd; border-radius: 8px; border: 2px solid #ddd;">
                <h4 style="margin-bottom: 10px;">早生まれ（1月〜3月生まれ）</h4>
                <p style="line-height: 1.8;">1月1日〜4月1日生まれの人は、同学年の中で誕生日が遅く、年齢が若いため「早生まれ」と呼ばれます。</p>
                <ul style="line-height: 1.8; margin-top: 10px;">
                    <li>体力・発達の差が気になる場合もある</li>
                    <li>入学時点で5歳の子もいる（4月1日生まれ）</li>
                </ul>
            </div>

            <div style="margin-bottom: 20px; padding: 15px; background: #d1ecf1; border-radius: 8px; border-left: 4px solid #17a2b8;">
                <h4 style="color: #0c5460; margin-bottom: 10px;">留年・浪人の場合</h4>
                <ul style="line-height: 1.8;">
                    <li><strong>留年：</strong>卒業が1年遅れる</li>
                    <li><strong>浪人：</strong>大学入学が1年以上遅れる</li>
                    <li><strong>飛び級：</strong>日本ではほとんどないが、一部の特別な制度あり</li>
                </ul>
            </div>

            <div style="margin-bottom: 20px; padding: 15px; background: #f8d7da; border-radius: 8px; border-left: 4px solid #dc3545;">
                <h4 style="color: #721c24; margin-bottom: 10px;">海外の学校との違い</h4>
                <ul style="line-height: 1.8;">
                    <li><strong>アメリカ：</strong>9月入学が一般的</li>
                    <li><strong>イギリス：</strong>9月入学、学年区切りは9月1日〜8月31日</li>
                    <li><strong>オーストラリア：</strong>1〜2月入学</li>
                    <li><strong>注意：</strong>海外留学時は学年の読み替えが必要</li>
                </ul>
            </div>
        </div>

        <div class="info-card">
            <h3>📚 教育費の目安</h3>
            <p>各段階で必要な教育費の参考額（公立・私立の違い）：</p>
            
            <div style="overflow-x: auto; margin-top: 15px;">
                <table style="width: 100%; border-collapse: collapse; background: white;">
                    <thead style="background: #f0f4f8;">
                        <tr>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">段階</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: right;">公立</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: right;">私立</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd;">小学校（6年間）</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約200万円</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約960万円</td>
                        </tr>
                        <tr style="background: #f9f9f9;">
                            <td style="padding: 12px; border: 1px solid #ddd;">中学校（3年間）</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約150万円</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約420万円</td>
                        </tr>
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd;">高校（3年間）</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約140万円</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約290万円</td>
                        </tr>
                        <tr style="background: #f9f9f9;">
                            <td style="padding: 12px; border: 1px solid #ddd;">大学（4年間）</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約240万円</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約400万円</td>
                        </tr>
                        <tr style="background: #e6f7ff; font-weight: bold;">
                            <td style="padding: 12px; border: 1px solid #ddd;">合計</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約730万円</td>
                            <td style="padding: 12px; border: 1px solid #ddd; text-align: right;">約2,070万円</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p style="margin-top: 10px; font-size: 0.9em; color: #666;">※ 文部科学省の調査より。塾や習い事を含む</p>
        </div>

        <div class="info-card">
            <h3>❓ よくある質問（FAQ）</h3>
            
            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q1. 4月1日生まれはなぜ早生まれなのですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 年齢は法律上、誕生日の前日（3月31日）に加算されます。そのため3月31日時点で6歳となり、4月1日入学の対象になります。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q2. 海外生まれの場合も同じですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. はい、生年月日で判断されるため、出生地に関わらず同じ計算方法です。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q3. 義務教育は何年間ですか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 小学校6年間と中学校3年間の合計9年間が義務教育です。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q4. 誕生日が学年途中の場合、いつ年齢が上がりますか？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. 誕生日当日に年齢が上がります。学年は4月〜3月ですが、年齢はそれぞれの誕生日に加算されます。</p>
            </div>

            <div class="faq-item" style="margin-bottom: 20px;">
                <h4 style="margin-bottom: 8px;">Q5. インターナショナルスクールの場合は？</h4>
                <p style="line-height: 1.7; padding-left: 15px; border-left: 3px solid #ddd;">A. インターナショナルスクールは独自の学年基準を持つ場合があります。多くは9月入学で、年齢区切りも異なります。</p>
            </div>
        </div>

        <div class="info-card">
            <h3>🔗 関連ツール・記事</h3>
            <div class="related-links" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="{{ route('datecalculator.age') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">年齢計算</a>
                <a href="{{ route('calculator.savings') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">教育資金の積立計算</a>
                <a href="{{ route('blog.show', 'school-entrance-calculation') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">入学年計算の記事</a>
                <a href="{{ route('blog.index') }}" style="padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; border: 2px solid #ddd;">ブログ記事一覧</a>
            </div>
        </div>
    </div>
</div>
@endsection
