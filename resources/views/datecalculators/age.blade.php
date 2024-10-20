@extends('layouts.app')

@section('content')
    <h1>年齢計算</h1>
    <p>生年月日を入力すると、現在の年齢を計算します。<br>このツールは、年齢に関連したイベントや計画を立てる際に役立ちます。</p>
    <form method="POST" action="{{ route('datecalculator.age') }}">
        @csrf
        <label for="birthdate">生年月日</label>
        <input type="date" name="birthdate" id="birthdate" required><br>

        <button type="submit">計算</button>
    </form>
@endsection
