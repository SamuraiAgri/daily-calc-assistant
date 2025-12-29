<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MoneyCalculatorController extends Controller
{
    /**
     * 共通バリデーションルール
     */
    private const LOAN_RULES = [
        'principal' => 'required|numeric|min:1|max:100000000',
        'rate' => 'required|numeric|min:0|max:100',
        'years' => 'required|integer|min:1|max:50',
        'method' => 'required|in:fixed,principal',
    ];

    private const SAVINGS_RULES = [
        'monthly_amount' => 'required|numeric|min:1|max:100000000',
        'rate' => 'required|numeric|min:0|max:100',
        'years' => 'required|integer|min:1|max:50',
    ];

    /**
     * 税率定数（所得税15% + 住民税5% + 復興特別所得税0.315%）
     */
    private const TAX_RATE = 0.20315;

    /**
     * ローン計算ページ表示
     * Note: $agent はViewServiceProviderで共有済み
     */
    public function loan()
    {
        return view('moneycalculators.loan');
    }

    /**
     * 毎月払いローン計算
     */
    public function calculateLoan(Request $request)
    {
        $validated = $request->validate(self::LOAN_RULES, [
            'principal.required' => '借入金額を入力してください',
            'principal.min' => '借入金額は1万円以上を入力してください',
            'rate.required' => '年利率を入力してください',
            'rate.min' => '年利率は0%以上を入力してください',
            'rate.max' => '年利率は100%以下を入力してください',
            'years.required' => '返済期間を入力してください',
            'years.min' => '返済期間は1年以上を入力してください',
        ]);

        $schedule = $this->calculateLoanSchedule(
            $validated['principal'],
            $validated['rate'],
            $validated['years'],
            $validated['method']
        );

        return view('moneycalculators.loan_result', $schedule);
    }

    /**
     * ボーナス併用ローン計算
     */
    public function calculateLoanWithBonus(Request $request)
    {
        $rules = array_merge(self::LOAN_RULES, [
            'bonus' => 'required|numeric|min:0|max:100000000',
        ]);

        $validated = $request->validate($rules, [
            'bonus.required' => 'ボーナス返済額を入力してください',
        ]);

        $schedule = $this->calculateLoanSchedule(
            $validated['principal'],
            $validated['rate'],
            $validated['years'],
            $validated['method'],
            $validated['bonus']
        );

        return view('moneycalculators.loan_with_bonus_result', $schedule);
    }

    /**
     * ローン返済スケジュール計算（共通ロジック）
     */
    private function calculateLoanSchedule(
        float $principal,
        float $rate,
        int $years,
        string $method,
        float $bonusPayment = 0
    ): array {
        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;
        $bonusTimesPerYear = 2;

        $schedule = [];
        $remainingPrincipal = $principal;
        $totalPayment = 0;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            if ($method === 'fixed') {
                // 元利均等返済
                $monthlyPayment = $monthlyRate > 0
                    ? $principal * $monthlyRate / (1 - pow(1 + $monthlyRate, -$months))
                    : $principal / $months;
                $interestPayment = $remainingPrincipal * $monthlyRate;
                $principalPayment = $monthlyPayment - $interestPayment;
            } else {
                // 元金均等返済
                $principalPayment = $principal / $months;
                $interestPayment = $remainingPrincipal * $monthlyRate;
                $monthlyPayment = $principalPayment + $interestPayment;
            }

            // ボーナス月の追加返済
            $bonusThisMonth = 0;
            if ($bonusPayment > 0 && $i % (12 / $bonusTimesPerYear) === 0) {
                $bonusThisMonth = $bonusPayment;
                $monthlyPayment += $bonusPayment;
            }

            $totalPayment += $monthlyPayment;
            $totalInterest += $interestPayment;
            $remainingPrincipal = max(0, $remainingPrincipal - $principalPayment);

            $schedule[] = [
                'month' => $i,
                'monthlyPayment' => $monthlyPayment,
                'principalPayment' => $principalPayment,
                'interestPayment' => $interestPayment,
                'remainingPrincipal' => $remainingPrincipal,
                'bonusPayment' => $bonusThisMonth,
            ];
        }

        return [
            'schedule' => $schedule,
            'totalPayment' => $totalPayment,
            'totalInterest' => $totalInterest,
            'method' => $method,
            'loanAmount' => $principal * 10000,
        ];
    }

    /**
     * 積立計算ページ表示
     */
    public function savings()
    {
        return view('moneycalculators.savings');
    }

    /**
     * 積立計算（基本）
     */
    public function calculateSavings(Request $request)
    {
        $validated = $request->validate(self::SAVINGS_RULES);

        $monthlyAmount = $validated['monthly_amount'];
        $rate = $validated['rate'];
        $years = $validated['years'];
        $totalAmount = $monthlyAmount * 12 * $years;

        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;

        // 複利での積立総額を計算（0除算対策）
        $futureValue = $monthlyRate > 0
            ? $monthlyAmount * ((pow(1 + $monthlyRate, $months) - 1) / $monthlyRate)
            : $monthlyAmount * $months;

        $interest = $futureValue - $totalAmount;
        $taxAmount = $interest * self::TAX_RATE;
        $finalFutureValueAfterTax = $futureValue - $taxAmount;

        return view('moneycalculators.savings_result', compact('finalFutureValueAfterTax', 'taxAmount'))
            ->with('totalInterest', $interest);
    }

    /**
     * 積立計算（ボーナス併用）
     */
    public function calculateSavingsWithBonus(Request $request)
    {
        $rules = array_merge(self::SAVINGS_RULES, [
            'bonus_amount' => 'required|numeric|min:0|max:100000000',
        ]);

        $validated = $request->validate($rules);

        $monthlyAmount = $validated['monthly_amount'];
        $bonusAmount = $validated['bonus_amount'];
        $rate = $validated['rate'];
        $years = $validated['years'];
        $bonusTimesPerYear = 2;

        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;

        $futureValue = 0;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            $futureValue += $monthlyAmount;
            if ($i % (12 / $bonusTimesPerYear) === 0) {
                $futureValue += $bonusAmount;
            }
            $interest = $futureValue * $monthlyRate;
            $futureValue += $interest;
            $totalInterest += $interest;
        }

        $taxAmount = $totalInterest * self::TAX_RATE;
        $finalFutureValueAfterTax = $futureValue - $taxAmount;
        
        return view('moneycalculators.savings_result', compact('finalFutureValueAfterTax', 'totalInterest', 'taxAmount'));
    }

    /**
     * 利息計算ページ表示
     */
    public function interest()
    {
        return view('moneycalculators.interest');
    }

    /**
     * 利息計算ロジック
     */
    public function calculateInterest(Request $request)
    {
        $validated = $request->validate([
            'principal' => 'required|numeric|min:1|max:100000000',
            'rate' => 'required|numeric|min:0|max:100',
            'years' => 'required|integer|min:1|max:100',
        ]);

        // 単利での利息計算
        $interest = $validated['principal'] * $validated['rate'] / 100 * $validated['years'];

        return view('moneycalculators.interest_result', compact('interest'));
    }

    /**
     * 割り勘計算ページ表示
     */
    public function splitBill()
    {
        return view('moneycalculators.split_bill');
    }

    /**
     * 割り勘計算ロジック
     */
    public function calculateSplitBill(Request $request)
    {
        $validated = $request->validate([
            'total_amount' => 'required|numeric|min:1|max:100000000',
            'num_people' => 'required|integer|min:1|max:1000',
        ], [
            'num_people.min' => '人数は1人以上を入力してください',
        ]);

        $totalAmount = $validated['total_amount'];
        $numPeople = $validated['num_people'];

        // 各人の支払額を計算
        $share = $totalAmount / $numPeople;

        // 割り切れるか確認し、フォーマットを選択
        if (fmod($totalAmount, $numPeople) == 0) {
            $shareFormatted = number_format($share, 0);
        } else {
            $shareFormatted = number_format($share, 1);
        }

        $adjustedAmounts = array_fill(0, $numPeople, $shareFormatted);

        return view('moneycalculators.split_bill_result', compact('adjustedAmounts', 'totalAmount', 'numPeople'));
    }

    /**
     * 消費税計算ページ表示
     */
    public function tax()
    {
        return view('moneycalculators.tax');
    }

    /**
     * 消費税計算ロジック
     */
    public function calculateTax(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0|max:100000000',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'type' => 'required|in:tax_included,tax_excluded',
            'unit' => 'required|in:yen,man',
            'rounding' => 'required|in:round,floor,ceil',
        ]);

        $amount = $validated['amount'];
        $taxRate = $validated['tax_rate'];
        $type = $validated['type'];
        $unit = $validated['unit'];
        $rounding = $validated['rounding'];

        // 単位が万円の場合は円に変換
        if ($unit === 'man') {
            $amount *= 10000;
        }

        // 税額と他の金額を計算
        if ($type === 'tax_included') {
            $taxAmount = $amount - ($amount / (1 + $taxRate / 100));
            $amountExcludingTax = $amount - $taxAmount;
            $amountIncludingTax = $amount;
        } else {
            $taxAmount = $amount * ($taxRate / 100);
            $amountExcludingTax = $amount;
            $amountIncludingTax = $amount + $taxAmount;
        }

        // 端数処理
        $taxAmount = $this->applyRounding($taxAmount, $rounding);
        $amountExcludingTax = $this->applyRounding($amountExcludingTax, $rounding);
        $amountIncludingTax = $this->applyRounding($amountIncludingTax, $rounding);

        return view('moneycalculators.tax_result', compact('amountExcludingTax', 'amountIncludingTax', 'taxAmount', 'taxRate'));
    }

    /**
     * 割引計算ページ表示
     */
    public function discount()
    {
        return view('moneycalculators.discount');
    }

    /**
     * 割引計算ロジック
     */
    public function calculateDiscount(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0|max:100000000',
            'discount_rate1' => 'required|numeric|min:0|max:100',
            'discount_rate2' => 'nullable|numeric|min:0|max:100',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'rounding' => 'required|in:round,floor,ceil',
            'unit' => 'nullable|in:yen,man',
            'type' => 'nullable|in:tax_included,tax_excluded',
        ]);

        $amount = $validated['amount'];
        $discountRate1 = $validated['discount_rate1'];
        $discountRate2 = $validated['discount_rate2'] ?? 0;
        $taxRate = $validated['tax_rate'] ?? 10;
        $rounding = $validated['rounding'];
        $unit = $validated['unit'] ?? 'yen';
        $type = $validated['type'] ?? 'tax_excluded';

        // 単位が「万円」の場合は「円」に変換
        if ($unit === 'man') {
            $amount *= 10000;
        }

        // 消費税を含めた金額を計算
        $amountExcludingTax = $type === 'tax_included'
            ? $amount / (1 + $taxRate / 100)
            : $amount;

        // 割引の適用
        $discountedAmount = $amountExcludingTax;
        $discount1 = $discountedAmount * ($discountRate1 / 100);
        $discountedAmount -= $discount1;

        $discount2 = $discountedAmount * ($discountRate2 / 100);
        $discountedAmount -= $discount2;

        $totalDiscount = $discount1 + $discount2;

        // 端数処理
        $discountedAmount = $this->applyRounding($discountedAmount, $rounding);

        // 税込みの場合の計算結果に税金を追加
        $discountedAmountIncludingTax = $type === 'tax_excluded'
            ? $discountedAmount * (1 + $taxRate / 100)
            : $discountedAmount;

        return view('moneycalculators.discount_result', compact(
            'amount', 'discountRate1', 'discountRate2', 'taxRate',
            'totalDiscount', 'discountedAmount', 'discountedAmountIncludingTax', 'rounding'
        ));
    }

    /**
     * 端数処理の共通メソッド
     */
    private function applyRounding(float $value, string $method): float
    {
        return match ($method) {
            'round' => round($value),
            'floor' => floor($value),
            'ceil' => ceil($value),
            default => round($value),
        };
    }
}
