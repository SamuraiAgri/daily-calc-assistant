@extends('layouts.app')

@section('content')
<div class="content-container">
    <h1>よくある質問（FAQ）</h1>
    
    <section class="faq-section">
        <p class="intro-text">
            Daily Calc Assistantのご利用に関して、よくいただく質問をまとめました。
        </p>

        <div class="faq-category">
            <h2>サービスについて</h2>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>Daily Calc Assistantとは何ですか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>日常生活で必要となる様々な計算を簡単に行えるツールを提供するWebサービスです。ローン返済、貯蓄計画、税金計算、日付計算など、生活に密着した計算機能を無料でご利用いただけます。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>利用料金はかかりますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>完全無料です。すべての計算機能を無料でご利用いただけます。会員登録も不要です。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>会員登録は必要ですか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>会員登録は不要です。サイトにアクセスするだけで、すぐに各種計算機能をご利用いただけます。</p>
                </div>
            </div>
        </div>

        <div class="faq-category">
            <h2>計算機能について</h2>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>どのような計算ができますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>以下の計算機能を提供しています：</p>
                    <ul>
                        <li><strong>金融計算：</strong>ローン返済、積み立て、利息、税金、割引、割り勘</li>
                        <li><strong>日付計算：</strong>年齢、入学・卒業年、経過日数</li>
                    </ul>
                    <p>詳しくは<a href="{{ route('home') }}">ホームページ</a>をご覧ください。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>計算結果の精度は信頼できますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>正確な計算を心がけておりますが、あくまで概算としてご利用ください。重要な金融判断を行う際は、金融機関や専門家にご相談されることをお勧めします。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>ローン計算で考慮されていない費用はありますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>手数料、保険料、保証料などは含まれていません。実際のローン契約では、これらの費用が別途発生する場合があります。詳細は金融機関にご確認ください。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>計算結果を保存できますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>現在、計算結果の保存機能は提供していません。必要に応じて、スクリーンショットを撮るか、メモアプリなどにコピーしてご利用ください。</p>
                </div>
            </div>
        </div>

        <div class="faq-category">
            <h2>プライバシーとセキュリティ</h2>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>入力したデータは保存されますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>計算機能で入力されたデータ（金額、日付など）は一切保存されません。計算はブラウザ上で完結し、サーバーには送信されません。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>個人情報の取り扱いについて教えてください</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>お問い合わせフォームから送信された情報以外に、個人情報を収集することはありません。詳しくは<a href="{{ route('privacy') }}">プライバシーポリシー</a>をご確認ください。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>クッキー（Cookie）は使用していますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>Google AnalyticsとGoogle AdSenseによるクッキーを使用しています。これらは統計情報の収集と広告配信の最適化に使用されます。詳しくは<a href="{{ route('privacy') }}">プライバシーポリシー</a>をご確認ください。</p>
                </div>
            </div>
        </div>

        <div class="faq-category">
            <h2>技術的な質問</h2>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>どのデバイスで利用できますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>パソコン、タブレット、スマートフォンなど、あらゆるデバイスでご利用いただけます。レスポンシブデザインにより、画面サイズに応じて最適な表示に調整されます。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>推奨ブラウザはありますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>以下のブラウザの最新版を推奨します：</p>
                    <ul>
                        <li>Google Chrome</li>
                        <li>Mozilla Firefox</li>
                        <li>Microsoft Edge</li>
                        <li>Safari</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>オフラインでも使用できますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>現在はインターネット接続が必要です。オフライン対応は今後の機能追加として検討しています。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>ページが正常に表示されません</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>以下をお試しください：</p>
                    <ul>
                        <li>ブラウザのキャッシュをクリアする</li>
                        <li>ブラウザを最新版にアップデートする</li>
                        <li>別のブラウザで試してみる</li>
                    </ul>
                    <p>解決しない場合は、<a href="{{ route('contact') }}">お問い合わせ</a>よりご連絡ください。</p>
                </div>
            </div>
        </div>

        <div class="faq-category">
            <h2>その他</h2>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>広告が表示されるのはなぜですか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>サービスを無料で提供するため、Google AdSenseによる広告を掲載しています。広告収益により、サーバー費用やサービス維持費用をまかなっています。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>新しい機能の追加予定はありますか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>ユーザーの皆様からのご要望を参考に、定期的に機能追加を行っています。ご要望やご提案がございましたら、<a href="{{ route('contact') }}">お問い合わせ</a>よりお聞かせください。</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span class="faq-icon">Q</span>
                    <h3>商用利用は可能ですか？</h3>
                </div>
                <div class="faq-answer">
                    <span class="faq-icon">A</span>
                    <p>個人・法人を問わず、無料でご利用いただけます。ただし、当サイトのコンテンツやデザインの無断転載・複製は禁止しています。</p>
                </div>
            </div>
        </div>

        <div class="contact-cta">
            <h2>解決しない場合は</h2>
            <p>上記で解決しない場合や、その他のご質問がございましたら、お気軽にお問い合わせください。</p>
            <a href="{{ route('contact') }}" class="contact-button">お問い合わせはこちら</a>
        </div>
    </section>
</div>
@endsection
