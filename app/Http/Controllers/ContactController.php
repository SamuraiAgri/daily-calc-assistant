<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * お問い合わせフォームを表示
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * お問い合わせフォームの送信処理
     */
    public function submit(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|in:質問,不具合報告,機能要望,その他',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'email.required' => 'メールアドレスは必須です',
            'email.email' => '有効なメールアドレスを入力してください',
            'subject.required' => '件名を選択してください',
            'message.required' => 'お問い合わせ内容を入力してください',
            'message.min' => 'お問い合わせ内容は10文字以上で入力してください',
            'message.max' => 'お問い合わせ内容は2000文字以内で入力してください',
        ]);

        // お問い合わせ内容をログに記録
        $this->logContact($validated);

        // メール送信処理（実際の運用では有効化）
        // $this->sendContactEmail($validated);

        // 成功メッセージを表示してリダイレクト
        return redirect()
            ->route('contact')
            ->with('success', 'お問い合わせを受け付けました。ご連絡ありがとうございます。');
    }

    /**
     * お問い合わせ内容をログに記録
     */
    private function logContact(array $data): void
    {
        Log::info('Contact form submission', [
            'name' => $data['name'] ?? '未記入',
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * お問い合わせメールを送信
     * 
     * @param array $data
     */
    private function sendContactEmail(array $data): void
    {
        // メール設定が完了している場合のみ有効化
        try {
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->to(config('mail.admin_email', 'admin@example.com'))
                    ->subject('[Daily Calc Assistant] ' . $data['subject'])
                    ->replyTo($data['email'], $data['name'] ?? '');
            });
        } catch (\Exception $e) {
            Log::error('Failed to send contact email', [
                'error' => $e->getMessage(),
                'email' => $data['email'],
            ]);
        }
    }
}
