@extends('layouts.app')

@section('content')
    <h1>日数計算</h1>
    <p>指定した日付から今日までの経過日数を計算します。<br>過去のイベントや記念日からの日数を確認する際に便利です。</p>
    <form method="POST" action="{{ route('datecalculator.daysSince') }}">
        @csrf
        <label for="start_date">開始日</label>
        <input type="date" name="start_date" id="start_date" required><br>

        <button type="submit">計算</button>
    </form>
@endsection
