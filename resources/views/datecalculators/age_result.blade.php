@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>年齢計算結果</h1>

    <p>生年月日 <strong>{{ $birthDate->format('Y年m月d日') }}</strong></p>
    <p>現在の年齢 <strong>{{ $age }} 歳</strong></p>
    <p>次の誕生日まで <strong>{{ $daysUntilNextBirthday }} 日</strong></p>

    <a href="{{ route('datecalculator.age') }}">再計算する</a>
</div>
@endsection
