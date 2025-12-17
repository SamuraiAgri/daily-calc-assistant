@extends('layouts.app')

@section('content')
<div class="blog-container">
    <div class="blog-header">
        <h1>{{ $categoryName }}</h1>
        <p class="blog-description">
            {{ $categoryName }}に関する記事一覧
        </p>
    </div>

    <div class="blog-categories">
        <a href="{{ route('blog.index') }}" class="category-tag">すべて</a>
        <a href="{{ route('blog.category', 'money') }}" class="category-tag {{ $category === 'money' ? 'active' : '' }}">金融・お金</a>
        <a href="{{ route('blog.category', 'date') }}" class="category-tag {{ $category === 'date' ? 'active' : '' }}">日付・時間</a>
        <a href="{{ route('blog.category', 'lifestyle') }}" class="category-tag {{ $category === 'lifestyle' ? 'active' : '' }}">ライフスタイル</a>
        <a href="{{ route('blog.category', 'tools') }}" class="category-tag {{ $category === 'tools' ? 'active' : '' }}">ツール・使い方</a>
    </div>

    <div class="articles-grid">
        @forelse($articles as $article)
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
        @empty
            <p class="no-articles">この カテゴリーの記事はまだありません。</p>
        @endforelse
    </div>
</div>
@endsection
