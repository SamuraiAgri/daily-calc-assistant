@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>入学・卒業年計算結果</h1>

    <p>生年月日 <strong>{{ $birthDate->format('Y年m月d日') }}</strong></p>

    <h2>学校制度に基づく入学・卒業年</h2>
    <ul>
        <li>中学校入学 <strong>{{ $juniorHighSchoolStart }}</strong></li>
        <li>中学校卒業 <strong>{{ $juniorHighSchoolEnd }}</strong></li>
        <li>高校入学 <strong>{{ $highSchoolStart }}</strong></li>
        <li>高校卒業 <strong>{{ $highSchoolEnd }}</strong></li>
        <li>大学入学 <strong>{{ $universityStart }}</strong></li>
        <li>大学卒業 <strong>{{ $universityEnd }}</strong></li>
    </ul>

    <a href="{{ route('datecalculator.schoolYears') }}">再計算する</a>
</div>
@endsection
