@extends('layouts.app')

@section('content')
    <h1>入学・卒業年計算</h1>
    <p>生年月日を入力して、中学校・高校・大学の入学および卒業年を計算します。<br>この計算ツールは、日本の学校制度に基づいており、教育計画を立てる際に便利です。</p>
    <form method="POST" action="{{ route('datecalculator.schoolYears') }}">
        @csrf
        <label for="birthdate">生年月日</label>
        <input type="date" name="birthdate" id="birthdate" required><br>

        <button type="submit">計算</button>
    </form>
@endsection
