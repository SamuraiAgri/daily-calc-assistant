@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>日数計算結果</h1>
    <p>指定日から経過した日数は <strong>{{ $daysPassed }} 日</strong> です。</p>
    <a href="{{ route('datecalculator.daysSince') }}">再計算する</a>
</div>
@endsection
