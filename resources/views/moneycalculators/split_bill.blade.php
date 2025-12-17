@extends('layouts.app')

@section('title', '割り勘計算 - 会計を均等に分担 | Daily Calc Assistant')
@section('description', '割り勘計算ツール。合計金額と人数を入力するだけで、1人あたりの支払額を計算。飲み会や食事会での費用分担に便利です。')
@section('keywords', '割り勘計算,割勘,分担,飲み会費用,支払い計算,均等割り')

@section('content')
<div class="calculator-container">
    <div class="calculator-header">
        <h1>割り勘計算</h1>
        <p class="calculator-description">合計金額と人数を入力して、均等に割り勘する金額を計算します。<br>飲み会や食事会での費用分担に便利です。</p>
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

    <form method="POST" action="{{ route('calculator.splitBill') }}">
        @csrf
        <label for="total_amount">合計金額（円）</label>
        <input type="number" name="total_amount" id="total_amount" placeholder="12000" value="{{ old('total_amount') }}" required>

        <label for="num_people">人数</label>
        <input type="number" name="num_people" id="num_people" placeholder="4" value="{{ old('num_people') }}" min="1" required>

        <button type="submit">計算</button>
    </form>
</div>
@endsection
