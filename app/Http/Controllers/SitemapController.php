<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * サイトマップXMLを生成
     */
    public function index(): Response
    {
        $urls = $this->getUrls();
        
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        
        foreach ($urls as $url) {
            $content .= '  <url>' . PHP_EOL;
            $content .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . PHP_EOL;
            $content .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
            $content .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
            $content .= '    <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
            $content .= '  </url>' . PHP_EOL;
        }
        
        $content .= '</urlset>';
        
        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }

    /**
     * サイトマップに含めるURLを取得
     */
    private function getUrls(): array
    {
        $baseUrl = config('app.url');
        $now = Carbon::now()->toDateString();
        
        return [
            // メインページ
            [
                'loc' => $baseUrl,
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            // ブログ
            [
                'loc' => $baseUrl . '/blog',
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            // 金融計算ツール
            [
                'loc' => $baseUrl . '/loan',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $baseUrl . '/savings',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $baseUrl . '/tax',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $baseUrl . '/interest',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            [
                'loc' => $baseUrl . '/split-bill',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            [
                'loc' => $baseUrl . '/discount',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            // 日付計算ツール
            [
                'loc' => $baseUrl . '/age',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $baseUrl . '/school-years',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            [
                'loc' => $baseUrl . '/days-since',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
            // 静的ページ
            [
                'loc' => $baseUrl . '/about',
                'lastmod' => $now,
                'changefreq' => 'yearly',
                'priority' => '0.5',
            ],
            [
                'loc' => $baseUrl . '/faq',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ],
            [
                'loc' => $baseUrl . '/contact',
                'lastmod' => $now,
                'changefreq' => 'yearly',
                'priority' => '0.4',
            ],
            [
                'loc' => $baseUrl . '/privacy',
                'lastmod' => $now,
                'changefreq' => 'yearly',
                'priority' => '0.3',
            ],
        ];
    }
}
