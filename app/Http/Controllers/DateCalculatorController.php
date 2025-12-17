<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class DateCalculatorController extends Controller
{
    /**
     * 共通の日付バリデーションルール
     */
    private const DATE_RULES = [
        'birthdate' => 'required|date|before_or_equal:today|after:1900-01-01',
    ];

    /**
     * 年齢計算ページ表示
     */
    public function age()
    {
        return view('datecalculators.age');
    }

    /**
     * 年齢計算ロジック
     */
    public function calculateAge(Request $request)
    {
        $validated = $request->validate(self::DATE_RULES, [
            'birthdate.required' => '生年月日を入力してください',
            'birthdate.date' => '有効な日付を入力してください',
            'birthdate.before_or_equal' => '生年月日は今日以前の日付を入力してください',
            'birthdate.after' => '1900年1月1日以降の日付を入力してください',
        ]);

        try {
            $birthDate = Carbon::parse($validated['birthdate']);
            $currentDate = Carbon::now();

            $age = $birthDate->age;

            // 次の誕生日を計算
            $nextBirthday = $birthDate->copy()->year($currentDate->year);
            if ($nextBirthday->isPast()) {
                $nextBirthday->addYear();
            }
            $daysUntilNextBirthday = $currentDate->diffInDays($nextBirthday);

            return view('datecalculators.age_result', compact('birthDate', 'age', 'daysUntilNextBirthday'));
        } catch (\Exception $e) {
            return back()->withErrors(['birthdate' => '日付の解析に失敗しました。正しい日付を入力してください。']);
        }
    }

    /**
     * 入学卒業年計算ページ表示
     */
    public function schoolYears()
    {
        return view('datecalculators.school_years');
    }

    /**
     * 入学卒業年計算ロジック
     */
    public function calculateSchoolYears(Request $request)
    {
        $validated = $request->validate(self::DATE_RULES, [
            'birthdate.required' => '生年月日を入力してください',
            'birthdate.date' => '有効な日付を入力してください',
        ]);

        try {
            $birthDate = Carbon::parse($validated['birthdate']);

            // 早生まれ（1月2日～4月1日生まれ）かどうかを判定
            $isEarlyBorn = $birthDate->month >= 1 && $birthDate->month <= 3 ||
                           ($birthDate->month === 4 && $birthDate->day === 1);

            // 学年開始年を計算（早生まれは1年前の学年）
            $schoolStartYear = $isEarlyBorn
                ? $birthDate->year + 5
                : $birthDate->year + 6;

            // 各学校の入学・卒業年を計算
            $elementarySchoolStart = $schoolStartYear . '年4月';
            $elementarySchoolEnd = ($schoolStartYear + 6) . '年3月';

            $juniorHighSchoolStart = ($schoolStartYear + 6) . '年4月';
            $juniorHighSchoolEnd = ($schoolStartYear + 9) . '年3月';

            $highSchoolStart = ($schoolStartYear + 9) . '年4月';
            $highSchoolEnd = ($schoolStartYear + 12) . '年3月';

            $universityStart = ($schoolStartYear + 12) . '年4月';
            $universityEnd = ($schoolStartYear + 16) . '年3月';

            return view('datecalculators.school_years_result', compact(
                'birthDate',
                'elementarySchoolStart', 'elementarySchoolEnd',
                'juniorHighSchoolStart', 'juniorHighSchoolEnd',
                'highSchoolStart', 'highSchoolEnd',
                'universityStart', 'universityEnd'
            ));
        } catch (\Exception $e) {
            return back()->withErrors(['birthdate' => '日付の解析に失敗しました。']);
        }
    }

    /**
     * 日数計算ページ表示
     */
    public function daysSince()
    {
        return view('datecalculators.days_since');
    }

    /**
     * 日数計算ロジック
     */
    public function calculateDaysSince(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after:1900-01-01',
        ], [
            'start_date.required' => '開始日を入力してください',
            'start_date.date' => '有効な日付を入力してください',
        ]);

        try {
            $startDate = Carbon::parse($validated['start_date']);
            $currentDate = Carbon::now();

            $daysPassed = $currentDate->diffInDays($startDate);

            return view('datecalculators.days_since_result', compact('daysPassed', 'startDate'));
        } catch (\Exception $e) {
            return back()->withErrors(['start_date' => '日付の解析に失敗しました。']);
        }
    }
}
