@extends('layouts.create')

@section('forms')

    <form action="{{ route('products.store') }}" method="post">
        @csrf
        <label for="name">Name of thr product </label>
        <input type="input" name="name" id="name" class="input">
        <label for="protein">Protein </label>
        <input type="number" name="protein" id="protein" class="input">
        <label for="carbs">Carbs </label>
        <input type="number" name="carbs" id="carbs" class="input">
        <label for="fats">Fats </label>
        <input type="number" name="fats" id="fats" class="input">
        <label for="fibre">Fiber </label>
        <input type="number" name="fibre" id="fibre" class="input">
        <label for="kkal">Kkal </label>
        <input type="number" name="kkal" id="kkal" class="input">

        <button type="submit" class="bg-slate-500">Create a product</button>
    </form>
     
@endsection