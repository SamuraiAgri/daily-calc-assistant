<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class DateCalculatorController extends Controller
{
    // 年齢計算ページの表示
    public function age()
    {
        return view('datecalculators.age', ['agent' => new Agent()]);
    }

    // 年齢計算ロジック
    public function calculateAge(Request $request)
    {
        $birthdate = $request->input('birthdate'); // 誕生日の入力
        $birthDate = Carbon::parse($birthdate);    // Carbonを使用して日付解析
        $currentDate = Carbon::now();

        // 年齢の計算
        $age = $birthDate->age;

        // 次の誕生日を計算
        $nextBirthday = $birthDate->copy()->year($currentDate->year);
        if ($nextBirthday->isPast()) {
            $nextBirthday->addYear();
        }
        $daysUntilNextBirthday = $currentDate->diffInDays($nextBirthday);

        return view('datecalculators.age_result', compact('birthDate', 'age', 'daysUntilNextBirthday'), ['agent' => new Agent()]);
    }
    // 入学卒業年計算ページの表示
    public function schoolYears()
    {
        return view('datecalculators.school_years', ['agent' => new Agent()]);
    }

    // 入学卒業年計算ロジック
    public function calculateSchoolYears(Request $request)
    {
        $birthdate = $request->input('birthdate');
        $birthDate = Carbon::parse($birthdate);

        // 学校制度に基づく入学年と卒業年（入学は4月、卒業は3月）
        $juniorHighSchoolStart = $birthDate->copy()->addYears(13)->year . '年4月';
        $juniorHighSchoolEnd = $birthDate->copy()->addYears(16)->year . '年3月';

        $highSchoolStart = $birthDate->copy()->addYears(16)->year . '年4月';
        $highSchoolEnd = $birthDate->copy()->addYears(19)->year . '年3月';

        $universityStart = $birthDate->copy()->addYears(19)->year . '年4月';
        $universityEnd = $birthDate->copy()->addYears(23)->year . '年3月';

        return view('datecalculators.school_years_result', compact(
            'birthDate',
            'juniorHighSchoolStart', 'juniorHighSchoolEnd',
            'highSchoolStart', 'highSchoolEnd',
            'universityStart', 'universityEnd'
        ), ['agent' => new Agent()]);
    }
    // 日数計算ページの表示
    public function daysSince() {
        return view('datecalculators.days_since', ['agent' => new Agent()]);
    }

    // 日数計算ロジック（指定日からの経過日数）
    public function calculateDaysSince(Request $request) {
        $startDate = Carbon::parse($request->input('start_date'));  // 開始日
        $currentDate = Carbon::now();  // 現在の日付

        // 開始日からの経過日数を計算
        $daysPassed = $currentDate->diffInDays($startDate);

        // 結果をビューに返す
        return view('datecalculators.days_since_result', compact('daysPassed'), ['agent' => new Agent()]);
    }
}
