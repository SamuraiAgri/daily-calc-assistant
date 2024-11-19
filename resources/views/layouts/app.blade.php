<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Calc Assistant</title>
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
        </nav>
    @endif
    </header>

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>

    <!-- フッター部分 -->
    <footer>
        <p>&copy; 2024 Daily Calc Assistant</p>
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
