@extends('layouts.app')

@section('content')
    <h1>割り勘計算</h1>
    <p>合計金額と人数を入力して、均等に割り勘する金額を計算します。<br>飲み会や食事会での費用分担に便利です。</p>
    <form method="POST" action="{{ route('calculator.splitBill') }}">
        @csrf
        <label for="total_amount">合計金額（円）</label>
        <input type="number" name="total_amount" id="total_amount" placeholder="12000" required>

        <label for="num_people">人数</label>
        <input type="number" name="num_people" id="num_people" placeholder="4" required>

        <button type="submit">計算</button>
    </form>
@endsection
