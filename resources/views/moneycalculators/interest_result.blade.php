@extends('layouts.app')

@section('content')
<div class="result-section">
    <h1>利息計算結果</h1>
    <p>利息額は <strong>{{ number_format($interest, 2) }} 円</strong> です。</p>
    <a href="{{ route('calculator.interest') }}">再計算する</a>
</div>
@endsection
