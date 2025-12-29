<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO基本メタタグ -->
    <title>@yield('title', 'Daily Calc Assistant - 無料の計算ツール')</title>
    <meta name="description" content="@yield('description', 'ローン計算、積立計算、税金計算、年齢計算など、日常生活で役立つ無料の計算ツールを提供。住宅ローンシミュレーション、消費税計算、割り勘計算などが簡単にできます。')">
    <meta name="keywords" content="@yield('keywords', 'ローン計算,積立計算,税金計算,消費税計算,年齢計算,割り勘計算,住宅ローン,シミュレーション,無料,計算ツール')">
    <meta name="author" content="Daily Calc Assistant">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- OGP（Open Graph Protocol）メタタグ -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'Daily Calc Assistant - 無料の計算ツール')">
    <meta property="og:description" content="@yield('og_description', '日常生活で役立つ無料の計算ツールを提供。ローン計算、税金計算、年齢計算などが簡単にできます。')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Daily Calc Assistant">
    <meta property="og:locale" content="ja_JP">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @else
        <meta property="og:image" content="{{ asset('images/og-default.png') }}">
    @endif
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Daily Calc Assistant')">
    <meta name="twitter:description" content="@yield('twitter_description', '日常生活で役立つ無料の計算ツール')">
    
    <!-- 構造化データ（JSON-LD） -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Daily Calc Assistant",
        "url": "{{ url('/') }}",
        "description": "日常生活で役立つ無料の計算ツールを提供",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/') }}?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
    @yield('structured_data')
    
    <!-- 共通のCSSファイル -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- モバイル用のCSSファイル（モバイルのみに適用） -->
    @if($agent->isMobile())
        <link rel="stylesheet" href="{{ asset('css/mobile.css') }}">
    @endif
    <!-- particles.jsのCDNを読み込み -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DEL37BWCPP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-DEL37BWCPP');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8001546494492220"
    crossorigin="anonymous"></script>
</head>
<body>
    <!-- パーティクルアニメーション用の要素 -->
    <div id="particles-js"></div>

    <!-- ヘッダー部分 -->
    <header>
    @if($agent->isMobile())
        <!-- モバイル版ハンバーガーメニュー -->
        <div class="hamburger-menu">
            <span class="hamburger-icon"></span>
            <span class="hamburger-icon"></span>
            <span class="hamburger-icon"></span>
        </div>

        <nav class="mobile-nav" style="display: none;">
            <ul>
                <li><a href="{{ route('home') }}">ホーム</a></li>
                <li><a href="{{ route('blog.index') }}">ブログ</a></li>
                <li><a href="{{ route('glossary.index') }}">用語集</a></li>
                <li><a href="{{ route('life-events.index') }}">ライフイベントガイド</a></li>
                <li><a href="{{ route('calculator.loan') }}">ローン計算</a></li>
                <li><a href="{{ route('calculator.savings') }}">積み立て計算</a></li>
                <li><a href="{{ route('calculator.interest') }}">利息計算</a></li>
                <li><a href="{{ route('calculator.splitBill') }}">割り勘計算</a></li>
                <li><a href="{{ route('calculator.tax') }}">税金計算</a></li>
                <li><a href="{{ route('calculator.discount') }}">割引計算</a></li>
                <li><a href="{{ route('datecalculator.age') }}">年齢計算</a></li>
                <li><a href="{{ route('datecalculator.schoolYears') }}">入学卒業年計算</a></li>
                <li><a href="{{ route('datecalculator.daysSince') }}">日数計算</a></li>
                <li><a href="{{ route('faq') }}">よくある質問</a></li>
                <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
            </ul>
        </nav>

        <script>
            document.querySelector('.hamburger-menu').addEventListener('click', function() {
                var mobileNav = document.querySelector('.mobile-nav');
                if (mobileNav.style.display === 'none' || mobileNav.style.display === '') {
                    mobileNav.style.display = 'flex';
                    mobileNav.classList.add('open');  // メニューを開いた際にクラスを追加
                } else {
                    mobileNav.style.display = 'none';
                    mobileNav.classList.remove('open');  // メニューを閉じた際にクラスを削除
                }
            });
        </script>

    @else
        <!-- デスクトップ版ナビゲーション -->
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">ホーム</a></li>
                <li><a href="{{ route('blog.index') }}">ブログ</a></li>
                <li><a href="{{ route('glossary.index') }}">用語集</a></li>
                <li><a href="{{ route('life-events.index') }}">ライフイベント</a></li>
                <li><a href="{{ route('faq') }}">よくある質問</a></li>
                <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
            </ul>
        </nav>
    @endif
    </header>

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>

    <!-- フッター部分 -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Daily Calc Assistant</h3>
                <p>日常生活で役立つ計算ツールを無料で提供</p>
            </div>
            <div class="footer-section">
                <h4>サイトマップ</h4>
                <ul>
                    <li><a href="{{ route('home') }}">ホーム</a></li>
                    <li><a href="{{ route('blog.index') }}">ブログ</a></li>
                    <li><a href="{{ route('glossary.index') }}">用語集</a></li>
                    <li><a href="{{ route('life-events.index') }}">ライフイベント</a></li>
                    <li><a href="{{ route('faq') }}">よくある質問</a></li>
                    <li><a href="{{ route('contact') }}">お問い合わせ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>計算ツール</h4>
                <ul>
                    <li><a href="{{ route('calculator.loan') }}">ローン計算</a></li>
                    <li><a href="{{ route('calculator.savings') }}">積み立て計算</a></li>
                    <li><a href="{{ route('calculator.interest') }}">利息計算</a></li>
                    <li><a href="{{ route('calculator.splitBill') }}">割り勘計算</a></li>
                    <li><a href="{{ route('calculator.tax') }}">税金計算</a></li>
                    <li><a href="{{ route('calculator.discount') }}">割引計算</a></li>
                    <li><a href="{{ route('datecalculator.age') }}">年齢計算</a></li>
                    <li><a href="{{ route('datecalculator.schoolYears') }}">入学卒業年計算</a></li>
                    <li><a href="{{ route('datecalculator.daysSince') }}">日数計算</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>情報</h4>
                <ul>
                    <li><a href="{{ route('about') }}">運営者情報</a></li>
                    <li><a href="{{ route('privacy') }}">プライバシーポリシー</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Daily Calc Assistant. All rights reserved.</p>
        </div>
    </footer>

    <!-- particles.jsの読み込みと初期化 -->
    <script>
        particlesJS.load('particles-js', '{{ asset('js/particles-config.js') }}', function() {
          console.log('particles.js loaded - callback');
        });

        // ページの高さに基づいてパーティクル背景を調整
        window.addEventListener('resize', function() {
            var height = document.body.scrollHeight;  // ページ全体の高さ
            document.getElementById('particles-js').style.height = height + 'px';
        });
    </script>
</body>
</html>
