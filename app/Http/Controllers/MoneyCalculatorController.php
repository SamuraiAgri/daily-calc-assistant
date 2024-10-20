<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class MoneyCalculatorController extends Controller
{
    // ローン計算ページ（毎月払いとボーナス併用払いを選択可能に）
    public function loan()
    {
        return view('moneycalculators.loan', ['agent' => new Agent()]);
    }

    // 毎月払いローン計算
    public function calculateLoan(Request $request)
    {
        $principal = $request->input('principal');  // 借入金額
        $rate = $request->input('rate');            // 年利率
        $years = $request->input('years');          // 返済期間（年）
        $method = $request->input('method');        // 返済方法（元利均等、元金均等）

        // 月利率
        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;

        // 各月の返済額を計算
        $schedule = [];
        $remainingPrincipal = $principal;
        $totalPayment = 0;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            if ($method == 'fixed') {
                // 元利均等返済
                $monthlyPayment = $principal * $monthlyRate / (1 - pow(1 + $monthlyRate, -$months));
                $interestPayment = $remainingPrincipal * $monthlyRate;
                $principalPayment = $monthlyPayment - $interestPayment;
            } else {
                // 元金均等返済
                $principalPayment = $principal / $months;
                $interestPayment = $remainingPrincipal * $monthlyRate;
                $monthlyPayment = $principalPayment + $interestPayment;
            }

            // 総支払額と総利息を加算
            $totalPayment += $monthlyPayment;
            $totalInterest += $interestPayment;

            // 残りの元本を計算
            $remainingPrincipal -= $principalPayment;

            // 各月の支払情報を保存
            $schedule[] = [
                'month' => $i,
                'monthlyPayment' => $monthlyPayment,
                'principalPayment' => $principalPayment,
                'interestPayment' => $interestPayment,
                'remainingPrincipal' => $remainingPrincipal,
            ];
        }

        return view('moneycalculators.loan_result', compact('schedule', 'totalPayment', 'totalInterest', 'method'), ['agent' => new Agent()]);
    }

    // ボーナス併用ローン計算
    public function calculateLoanWithBonus(Request $request)
    {
        $principal = $request->input('principal');   // 借入金額
        $rate = $request->input('rate');             // 年利率
        $years = $request->input('years');           // 返済期間（年）
        $bonusPayment = $request->input('bonus');    // ボーナス返済額
        $bonusTimesPerYear = 2;                      // ボーナス返済の回数（年2回）
        $method = $request->input('method');         // 返済方法（元利均等、元金均等）

        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;
        $schedule = [];
        $remainingPrincipal = $principal;
        $totalPayment = 0;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            if ($method == 'fixed') {
                $monthlyPayment = $principal * $monthlyRate / (1 - pow(1 + $monthlyRate, -$months));
                $interestPayment = $remainingPrincipal * $monthlyRate;
                $principalPayment = $monthlyPayment - $interestPayment;
            } else {
                $principalPayment = $principal / $months;
                $interestPayment = $remainingPrincipal * $monthlyRate;
                $monthlyPayment = $principalPayment + $interestPayment;
            }

            if ($i % (12 / $bonusTimesPerYear) == 0) {
                $monthlyPayment += $bonusPayment;
                $totalPayment += $bonusPayment;
            }

            $totalPayment += $monthlyPayment;
            $totalInterest += $interestPayment;

            $remainingPrincipal -= $principalPayment;

            $schedule[] = [
                'month' => $i,
                'monthlyPayment' => $monthlyPayment,
                'principalPayment' => $principalPayment,
                'interestPayment' => $interestPayment,
                'remainingPrincipal' => $remainingPrincipal,
            ];
        }

        return view('moneycalculators.loan_with_bonus_result', compact('schedule', 'totalPayment', 'totalInterest', 'method'), ['agent' => new Agent()]);
    }

    // 積立計算ページの表示
    public function savings()
    {
        return view('moneycalculators.savings', ['agent' => new Agent()]);
    }

    // 積立計算（満期一括課税）
    public function calculateLumpSum(Request $request)
    {
        $monthlyAmount = $request->input('monthly_amount');  // 毎月積立額
        $rate = $request->input('rate');                     // 年利率
        $years = $request->input('years');                   // 積立期間（年）
        $totalAmount = $monthlyAmount * 12 * $years;         // 元本合計

        // 利率を月ベースに変換
        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;

        // 複利での積立総額を計算
        $futureValue = $monthlyAmount * ((pow(1 + $monthlyRate, $months) - 1) / $monthlyRate);

        // 利息に対する課税額（満期一括）
        $taxRate = 0.2;  // 20% の税率
        $interest = $futureValue - $totalAmount;
        $taxAmount = $interest * $taxRate;
        $futureValueAfterTax = $futureValue - $taxAmount;

        return view('moneycalculators.savings_result', compact('futureValueAfterTax', 'interest', 'taxAmount'), ['agent' => new Agent()]);
    }

    // 積立計算（複利毎課税）
    public function calculateCompoundTax(Request $request)
    {
        $monthlyAmount = $request->input('monthly_amount');  // 毎月積立額
        $rate = $request->input('rate');                     // 年利率
        $years = $request->input('years');                   // 積立期間（年）

        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;
        $taxRate = 0.2;

        $futureValue = 0;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            $futureValue += $monthlyAmount;
            $interest = $futureValue * $monthlyRate;
            $taxAmount = $interest * $taxRate;
            $futureValue += ($interest - $taxAmount);
            $totalInterest += $interest;
        }

        $futureValueAfterTax = $futureValue;
        return view('moneycalculators.savings_result', compact('futureValueAfterTax', 'totalInterest'), ['agent' => new Agent()]);
    }

    // 積立計算（ボーナス併用 - 満期一括課税）
    public function calculateBonusLumpSum(Request $request)
    {
        $monthlyAmount = $request->input('monthly_amount');
        $bonusAmount = $request->input('bonus_amount');
        $rate = $request->input('rate');
        $years = $request->input('years');
        $bonusTimesPerYear = 2;

        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;
        $totalAmount = ($monthlyAmount * 12 * $years) + ($bonusAmount * $bonusTimesPerYear * $years);
        $futureValue = $monthlyAmount * ((pow(1 + $monthlyRate, $months) - 1) / $monthlyRate);
        $bonusFutureValue = $bonusAmount * ((pow(1 + $monthlyRate, $months / 6) - 1) / $monthlyRate);

        $finalFutureValue = $futureValue + $bonusFutureValue;
        $interest = $finalFutureValue - $totalAmount;
        $taxAmount = $interest * 0.2;
        $finalFutureValueAfterTax = $finalFutureValue - $taxAmount;

        return view('moneycalculators.savings_result', compact('finalFutureValueAfterTax', 'interest', 'taxAmount'), ['agent' => new Agent()]);
    }

    // 積立計算（ボーナス併用 - 複利毎課税）
    public function calculateBonusCompoundTax(Request $request)
    {
        $monthlyAmount = $request->input('monthly_amount');
        $bonusAmount = $request->input('bonus_amount');
        $rate = $request->input('rate');
        $years = $request->input('years');
        $bonusTimesPerYear = 2;

        $monthlyRate = $rate / 12 / 100;
        $months = $years * 12;
        $taxRate = 0.2;

        $futureValue = 0;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            $futureValue += $monthlyAmount;
            if ($i % (12 / $bonusTimesPerYear) == 0) {
                $futureValue += $bonusAmount;
            }
            $interest = $futureValue * $monthlyRate;
            $taxAmount = $interest * $taxRate;
            $futureValue += ($interest - $taxAmount);
            $totalInterest += $interest;
        }

        $finalFutureValueAfterTax = $futureValue;
        return view('moneycalculators.savings_result', compact('finalFutureValueAfterTax', 'totalInterest'), ['agent' => new Agent()]);
    }
    // 利息計算ページの表示
    public function interest() {
        return view('moneycalculators.interest', ['agent' => new Agent()]);
    }

    // 利息計算ロジック
    public function calculateInterest(Request $request) {
        $principal = $request->input('principal');  // 元金
        $rate = $request->input('rate');            // 利率（年率）
        $years = $request->input('years');          // 期間（年）

        // 単利での利息計算
        $interest = $principal * $rate / 100 * $years;

        // 結果をビューに返す
        return view('moneycalculators.interest_result', compact('interest'), ['agent' => new Agent()]);
    }

    // 割り勘計算ページの表示
    public function splitBill()
    {
        return view('moneycalculators.split_bill', ['agent' => new Agent()]);
    }

    // 割り勘計算ロジック
    public function calculateSplitBill(Request $request)
    {
        $totalAmount = $request->input('total_amount'); // 合計金額
        $numPeople = $request->input('num_people');     // 人数

        // 各人の支払額を計算
        $share = $totalAmount / $numPeople;

        // 割り切れるか確認し、フォーマットを選択
        if (fmod($totalAmount, $numPeople) == 0) {
            // 割り切れる場合は整数で表示
            $shareFormatted = number_format($share, 0);
        } else {
            // 割り切れない場合は小数点第一位まで表示
            $shareFormatted = number_format($share, 1);
        }

        // 配列に各人の支払額を追加
        $adjustedAmounts = array_fill(0, $numPeople, $shareFormatted);

        return view('moneycalculators.split_bill_result', compact('adjustedAmounts', 'totalAmount', 'numPeople'), ['agent' => new Agent()]);
    }
    
    // 消費税計算ページの表示
    public function tax()
    {
        return view('moneycalculators.tax', ['agent' => new Agent()]);
    }

    // 消費税計算ロジック
    public function calculateTax(Request $request)
    {
        $amount = $request->input('amount');          // 入力された金額
        $taxRate = $request->input('tax_rate');       // 消費税率（%）
        $type = $request->input('type');              // 税込みか税抜きかのタイプ
        $unit = $request->input('unit');              // 単位（円 or 万円）
        $rounding = $request->input('rounding');      // 端数処理のタイプ

        // 単位が万円の場合は円に変換
        if ($unit == 'man') {
            $amount *= 10000;
        }

        // 税額と他の金額を計算
        if ($type == 'tax_included') {
            // 税込金額が入力された場合
            $taxAmount = $amount - ($amount / (1 + $taxRate / 100));
            $amountExcludingTax = $amount - $taxAmount;
            $amountIncludingTax = $amount;
        } else {
            // 税抜金額が入力された場合
            $taxAmount = $amount * ($taxRate / 100);
            $amountExcludingTax = $amount;
            $amountIncludingTax = $amount + $taxAmount;
        }

        // 端数処理
        switch ($rounding) {
            case 'round':
                $taxAmount = round($taxAmount);
                $amountExcludingTax = round($amountExcludingTax);
                $amountIncludingTax = round($amountIncludingTax);
                break;
            case 'floor':
                $taxAmount = floor($taxAmount);
                $amountExcludingTax = floor($amountExcludingTax);
                $amountIncludingTax = floor($amountIncludingTax);
                break;
            case 'ceil':
                $taxAmount = ceil($taxAmount);
                $amountExcludingTax = ceil($amountExcludingTax);
                $amountIncludingTax = ceil($amountIncludingTax);
                break;
        }

        return view('moneycalculators.tax_result', compact('amountExcludingTax', 'amountIncludingTax', 'taxAmount', 'taxRate'), ['agent' => new Agent()]);
    }

    // 割引計算ページの表示
    public function discount()
    {
        return view('moneycalculators.discount', ['agent' => new Agent()]);
    }

    // 割引計算ロジック
    public function calculateDiscount(Request $request)
    {
        $amount = $request->input('amount');                   // 元の金額
        $discountRate1 = $request->input('discount_rate1');    // 1回目の割引率
        $discountRate2 = $request->input('discount_rate2');    // 2回目の割引率
        $taxRate = $request->input('tax_rate', 10);            // 消費税率
        $rounding = $request->input('rounding');               // 端数処理方法（四捨五入、切り捨て、切り上げ）
        $unit = $request->input('unit', 'yen');                // 単位
        $type = $request->input('type', 'tax_excluded');       // 税込みか税抜きか

        // 単位が「万円」の場合は「円」に変換
        if ($unit == 'man') {
            $amount *= 10000;
        }

        // 消費税を含めた金額を計算
        if ($type == 'tax_included') {
            $amountExcludingTax = $amount / (1 + $taxRate / 100);
        } else {
            $amountExcludingTax = $amount;
        }

        // 割引の適用
        $discountedAmount = $amountExcludingTax;
        $discount1 = $discountedAmount * ($discountRate1 / 100);
        $discountedAmount -= $discount1;

        $discount2 = $discountedAmount * ($discountRate2 / 100);
        $discountedAmount -= $discount2;

        $totalDiscount = $discount1 + $discount2;

        // 端数処理
        switch ($rounding) {
            case 'round':
                $discountedAmount = round($discountedAmount);
                break;
            case 'floor':
                $discountedAmount = floor($discountedAmount);
                break;
            case 'ceil':
                $discountedAmount = ceil($discountedAmount);
                break;
        }

        // 税込みの場合の計算結果に税金を追加
        if ($type == 'tax_excluded') {
            $discountedAmountIncludingTax = $discountedAmount * (1 + $taxRate / 100);
        } else {
            $discountedAmountIncludingTax = $discountedAmount;
        }

        return view('moneycalculators.discount_result', compact('amount', 'discountRate1', 'discountRate2', 'taxRate', 'totalDiscount', 'discountedAmount', 'discountedAmountIncludingTax', 'rounding'), ['agent' => new Agent()]);
    }
}
