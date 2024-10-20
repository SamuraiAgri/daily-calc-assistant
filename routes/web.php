<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoneyCalculatorController;
use App\Http\Controllers\DateCalculatorController;

// ホームページ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Money関連の計算
Route::get('/loan', [MoneyCalculatorController::class, 'loan'])->name('calculator.loan');
Route::post('/loan', [MoneyCalculatorController::class, 'calculateLoan']);
Route::post('/loan-with-bonus', [MoneyCalculatorController::class, 'calculateLoanWithBonus'])->name('calculator.loanWithBonus');

Route::get('/savings', [MoneyCalculatorController::class, 'savings'])->name('calculator.savings');
Route::post('/savings-lump-sum', [MoneyCalculatorController::class, 'calculateLumpSum'])->name('calculator.savingsLumpSum');
Route::post('/savings-compound-tax', [MoneyCalculatorController::class, 'calculateCompoundTax'])->name('calculator.savingsCompoundTax');
Route::post('/savings-bonus-lump-sum', [MoneyCalculatorController::class, 'calculateBonusLumpSum'])->name('calculator.savingsBonusLumpSum');
Route::post('/savings-bonus-compound-tax', [MoneyCalculatorController::class, 'calculateBonusCompoundTax'])->name('calculator.savingsBonusCompoundTax');

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
