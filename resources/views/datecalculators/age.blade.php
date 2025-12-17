@extends('layouts.app')

@section('title', '年齢計算 - 生年月日から現在の年齢を計算 | Daily Calc Assistant')
@section('description', '生年月日を入力するだけで現在の年齢を計算。次の誕生日までの日数もわかります。履歴書作成や年齢確認に便利なツールです。')
@section('keywords', '年齢計算,生年月日,誕生日計算,年齢確認,履歴書,満年齢')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>年齢計算</h1>
        <p class="calculator-description">生年月日を入力すると、現在の年齢を計算します。<br>このツールは、年齢に関連したイベントや計画を立てる際に役立ちます。</p>
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

    <form method="POST" action="{{ route('datecalculator.age') }}">
        @csrf
        <label for="birthdate">生年月日</label>
        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required><br>

        <button type="submit">計算</button>
    </form>
</div>
@endsection
