@extends('layouts.app')

@section('content')
<div class="blog-container">
    <div class="blog-header">
        <h1>お役立ちブログ</h1>
        <p class="blog-description">
            計算に関する便利な知識や、日常生活で役立つ情報をお届けします
        </p>
    </div>

    <div class="blog-categories">
        <a href="{{ route('blog.index') }}" class="category-tag active">すべて</a>
        <a href="{{ route('blog.category', 'money') }}" class="category-tag">金融・お金</a>
        <a href="{{ route('blog.category', 'date') }}" class="category-tag">日付・時間</a>
        <a href="{{ route('blog.category', 'lifestyle') }}" class="category-tag">ライフスタイル</a>
        <a href="{{ route('blog.category', 'tools') }}" class="category-tag">ツール・使い方</a>
    </div>

    <div class="articles-grid">
        @foreach($articles as $article)
            <article class="article-card">
                <div class="article-header">
                    <span class="article-category category-{{ $article['category'] }}">
                        @if($article['category'] === 'money') 金融・お金
                        @elseif($article['category'] === 'date') 日付・時間
                        @elseif($article['category'] === 'lifestyle') ライフスタイル
                        @elseif($article['category'] === 'tools') ツール・使い方
                        @endif
                    </span>
                    <span class="article-date">{{ $article['published_at'] }}</span>
                </div>
                
                <h2 class="article-title">
                    <a href="{{ route('blog.show', $article['slug']) }}">
                        {{ $article['title'] }}
                    </a>
                </h2>
                
                <p class="article-excerpt">
                    {{ $article['excerpt'] }}
                </p>
                
                <div class="article-footer">
                    <div class="article-tags">
                        @foreach($article['tags'] as $tag)
                            <span class="tag">#{{ $tag }}</span>
                        @endforeach
                    </div>
                    <span class="reading-time">📖 {{ $article['reading_time'] }}</span>
                </div>
                
                <a href="{{ route('blog.show', $article['slug']) }}" class="read-more">
                    続きを読む →
                </a>
            </article>
        @endforeach
    </div>
</div>
@endsection
