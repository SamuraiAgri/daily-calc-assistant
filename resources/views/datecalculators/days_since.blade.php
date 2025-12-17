@extends('layouts.app')

@section('title', '日数計算 - 経過日数を簡単に計算 | Daily Calc Assistant')
@section('description', '指定した日付から今日までの経過日数を計算。記念日からの日数、プロジェクトの経過日数などを簡単に確認できます。')
@section('keywords', '日数計算,経過日数,日数カウント,記念日計算,日付計算')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>日数計算</h1>
        <p class="calculator-description">指定した日付から今日までの経過日数を計算します。<br>過去のイベントや記念日からの日数を確認する際に便利です。</p>
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

    <form method="POST" action="{{ route('datecalculator.daysSince') }}">
        @csrf
        <label for="start_date">開始日</label>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required><br>

        <button type="submit">計算</button>
    </form>
</div>
@endsection
