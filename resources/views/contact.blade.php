@extends('layouts.app')

@section('content')
<div class="content-container">
    <h1>お問い合わせ</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="contact-section">
        <p class="intro-text">
            サイトに関するご質問、ご要望、不具合報告などがございましたら、下記フォームよりお気軽にお問い合わせください。
        </p>
        <p class="response-time">
            通常、3営業日以内に返信いたします。
        </p>

        <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
            @csrf
            
            <div class="form-group">
                <label for="name">お名前（任意）</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="山田 太郎"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="email">メールアドレス <span class="required">*</span></label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
                    class="form-control"
                    required
                >
                <small class="form-text">返信先のメールアドレスをご入力ください</small>
            </div>

            <div class="form-group">
                <label for="subject">件名 <span class="required">*</span></label>
                <select id="subject" name="subject" class="form-control" required>
                    <option value="">選択してください</option>
                    <option value="質問" {{ old('subject') == '質問' ? 'selected' : '' }}>質問</option>
                    <option value="不具合報告" {{ old('subject') == '不具合報告' ? 'selected' : '' }}>不具合報告</option>
                    <option value="機能要望" {{ old('subject') == '機能要望' ? 'selected' : '' }}>機能要望</option>
                    <option value="その他" {{ old('subject') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">お問い合わせ内容 <span class="required">*</span></label>
                <textarea 
                    id="message" 
                    name="message" 
                    rows="8" 
                    class="form-control"
                    placeholder="お問い合わせ内容をご記入ください"
                    required
                >{{ old('message') }}</textarea>
                <small class="form-text">できるだけ詳しくご記入いただけると助かります</small>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">送信する</button>
            </div>
        </form>

        <div class="contact-info">
            <h2>その他のお問い合わせ先</h2>
            <p>フォームからのお問い合わせが難しい場合は、以下の方法でもお問い合わせいただけます：</p>
            <ul>
                <li>サイトに関する一般的なご質問は、<a href="{{ route('faq') }}">よくある質問</a>もご確認ください</li>
                <li>プライバシーに関するお問い合わせは、<a href="{{ route('privacy') }}">プライバシーポリシー</a>をご確認ください</li>
            </ul>
        </div>
    </section>
</div>
@endsection
