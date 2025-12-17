@extends('layouts.app')

@section('title', '入学・卒業年計算 - 生年月日から学歴を計算 | Daily Calc Assistant')
@section('description', '生年月日から小学校・中学校・高校・大学の入学・卒業年を計算。日本の学校制度に対応し、早生まれも考慮した正確な計算が可能です。')
@section('keywords', '入学年計算,卒業年計算,学歴計算,早生まれ,小学校入学,中学校入学,高校入学,大学入学')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>入学・卒業年計算</h1>
        <p class="calculator-description">生年月日を入力して、中学校・高校・大学の入学および卒業年を計算します。<br>この計算ツールは、日本の学校制度に基づいており、教育計画を立てる際に便利です。</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('datecalculator.schoolYears') }}">
        @csrf
        <label for="birthdate">生年月日</label>
        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required><br>

        <button type="submit">計算</button>
    </form>
</div>
@endsection
