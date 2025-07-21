@extends('layouts.create')

@section('forms')
    
    @if($date)
        {{ $date->format('d.m.Y') }}
    @else
        Дата не указана
    @endif

    <form action="{{ route('entries.store') }}" method="post">
        @csrf
        <label for="weight">Вес (гр) </label>
        <input type="text" name="weight" id="" class="input">

        <label for="product">Продукт </label>
        <input list="products-list" name="product" id="product-input" class="input">
        <datalist id="products-list">
            @foreach($products as $product)
                <option value="{{ $product->name }}">{{ $product->name }}</option>
            @endforeach
        </datalist>

        <button type="submit" class="bg-slate-500">Создать запись</button>

    </form>
     
@endsection