@extends('layouts.app')

@section('content')
<div class="article-container">
    <article class="article-content">
        <div class="article-meta">
            <span class="article-category category-{{ $article['category'] }}">
                @if($article['category'] === 'money') 金融・お金
                @elseif($article['category'] === 'date') 日付・時間
                @elseif($article['category'] === 'lifestyle') ライフスタイル
                @elseif($article['category'] === 'tools') ツール・使い方
                @endif
            </span>
            <span class="article-date">{{ $article['published_at'] }}</span>
            <span class="reading-time">📖 {{ $article['reading_time'] }}</span>
        </div>

        <h1 class="article-title">{{ $article['title'] }}</h1>

        <div class="article-tags">
            @foreach($article['tags'] as $tag)
                <span class="tag">#{{ $tag }}</span>
            @endforeach
        </div>

        <div class="article-body">
            @if(!empty($article['content']))
                {!! $article['content'] !!}
            @else
                <div class="article-section">
                    <h2>この記事について</h2>
                    <p>{{ $article['excerpt'] }}</p>
                    <p>詳細な内容は近日公開予定です。</p>
                </div>
            @endif
        </div>

        <div class="article-footer-actions">
            <a href="{{ route('blog.index') }}" class="back-button">← 記事一覧に戻る</a>
        </div>
    </article>

    @if(count($relatedArticles) > 0)
    <aside class="related-articles">
        <h2>関連記事</h2>
        <div class="related-grid">
            @foreach($relatedArticles as $related)
                <a href="{{ route('blog.show', $related['slug']) }}" class="related-card">
                    <span class="related-category category-{{ $related['category'] }}">
                        @if($related['category'] === 'money') 金融・お金
                        @elseif($related['category'] === 'date') 日付・時間
                        @elseif($related['category'] === 'lifestyle') ライフスタイル
                        @elseif($related['category'] === 'tools') ツール・使い方
                        @endif
                    </span>
                    <h3>{{ $related['title'] }}</h3>
                    <p>{{ Str::limit($related['excerpt'], 80) }}</p>
                </a>
            @endforeach
        </div>
    </aside>
    @endif
</div>
@endsection
