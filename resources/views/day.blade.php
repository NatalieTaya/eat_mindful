@extends('layouts.app')

@section('forms')
    <form action="{{ route('show.week') }}" method="post" class="btn">
            @csrf
            <input type="week" name="week" 
            class="px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            onchange="this.form.submit()">
    </form>

    <a href="{{ route('products.create') }}"> 
        Create a product 
    </a> 
   
@endsection

@section('data_on_days')
        @php
            $day_params=session('return_to_day_params');
            $meals=['Завтрак', 'Обед', 'Ужин'];
            //$date = new DateTime($selectedDate)
            $date = new DateTime($day_params['selectedDate']);
            $breakfastEntries=$day_params['breakfastEntries'];
            $lunchEntries=$day_params['lunchEntries'];
            $dinnerEntries=$day_params['dinnerEntries'];
            //dd($dinnerEntries);
        @endphp
        <div class="">
            {{ $date->format('d.m.Y')}}
        </div>
        <div class="week">
            <div>
                <h2>{{ $meals[0] }}</h2>
                <div class="meal">
                    @foreach ( $breakfastEntries as $item )
                        {{ $item->product->name }}<br>
                        kkal: {{ $item->weight * $item->product->kkal/100 }}<br>
                        @php $total = $item->weight * $item->product->kkal/100 @endphp
                    @endforeach
                    <a href="{{ route('entries.create', [
                            'date' => $date->format('Y-m-d'),
                            'meal' => 1
                        ]) 
                    }}" > Добавить новую запись</a> 
                </div>
            </div>
            <div>
                <h2>{{ $meals[1] }}</h2>
                <div class="meal">
                    @foreach ( $lunchEntries as $item )
                        {{ $item->product->name }}<br>
                        kkal: {{  $item->weight * $item->product->kkal/100 }}<br>
                        @php $total += $item->weight * $item->product->kkal/100 @endphp
                    @endforeach
                    <a href="{{ route('entries.create', [
                            'date' => $date->format('Y-m-d'),
                            'meal' => 2
                        ]) 
                    }}" > Добавить новую запись</a> 
                </div>
            </div>    
            <div>
                <h2>{{ $meals[2] }}</h2>
                <div class="meal">
                    @foreach ( $dinnerEntries as $item )
                        {{ $item->product->name }}<br>
                        kkal: {{ $item->weight * $item->product->kkal/100 }}<br>
                        @php $total += $item->weight * $item->product->kkal/100 @endphp
                    @endforeach
                    <a href="{{ route('entries.create', [
                            'date' => $date->format('Y-m-d'),
                            'meal' => 3
                        ]) 
                    }}" > Добавить новую запись</a>                     
                </div>
            </div>
                
            <div>
                Total kkal: {{ $total }}
            </div>
        </div>  
@endsection
