<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoneyCalculatorController;
use App\Http\Controllers\DateCalculatorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\GlossaryController;
use App\Http\Controllers\LifeEventController;

// ホームページ
Route::get('/', [HomeController::class, 'index'])->name('home');

// サイトマップ
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// 静的ページ
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');

// 用語集
Route::get('/glossary', [GlossaryController::class, 'index'])->name('glossary.index');
Route::get('/glossary/category/{category}', [GlossaryController::class, 'category'])->name('glossary.category');

// ライフイベントガイド
Route::get('/life-events', [LifeEventController::class, 'index'])->name('life-events.index');
Route::get('/life-events/{slug}', [LifeEventController::class, 'show'])->name('life-events.show');

// お問い合わせ
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ブログ
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Money関連の計算
Route::get('/loan', [MoneyCalculatorController::class, 'loan'])->name('calculator.loan');
Route::post('/loan', [MoneyCalculatorController::class, 'calculateLoan']);
Route::post('/loan-with-bonus', [MoneyCalculatorController::class, 'calculateLoanWithBonus'])->name('calculator.loanWithBonus');

Route::get('/savings', [MoneyCalculatorController::class, 'savings'])->name('calculator.savings');
Route::post('/savings', [MoneyCalculatorController::class, 'calculateSavings']);
Route::post('/savings-with-bonus', [MoneyCalculatorController::class, 'calculateSavingsWithBonus'])->name('calculator.savingsWithBonus');

Route::get('/tax', [MoneyCalculatorController::class, 'tax'])->name('calculator.tax');
Route::post('/tax', [MoneyCalculatorController::class, 'calculateTax']);

Route::get('/interest', [MoneyCalculatorController::class, 'interest'])->name('calculator.interest');
Route::post('/interest', [MoneyCalculatorController::class, 'calculateInterest']);

Route::get('/split-bill', [MoneyCalculatorController::class, 'splitBill'])->name('calculator.splitBill');
Route::post('/split-bill', [MoneyCalculatorController::class, 'calculateSplitBill']);

Route::get('/discount', [MoneyCalculatorController::class, 'discount'])->name('calculator.discount');
Route::post('/discount', [MoneyCalculatorController::class, 'calculateDiscount']);

// 日付関連の計算
Route::get('/age', [DateCalculatorController::class, 'age'])->name('datecalculator.age');
Route::post('/age', [DateCalculatorController::class, 'calculateAge']);

Route::get('/school-years', [DateCalculatorController::class, 'schoolYears'])->name('datecalculator.schoolYears');
Route::post('/school-years', [DateCalculatorController::class, 'calculateSchoolYears']);

Route::get('/days-since', [DateCalculatorController::class, 'daysSince'])->name('datecalculator.daysSince');
Route::post('/days-since', [DateCalculatorController::class, 'calculateDaysSince']);
