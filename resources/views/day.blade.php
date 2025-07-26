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
            $entries=$day_params['entries'];
            $mealEntries=[];
            $mealEntries[]=$day_params['breakfastEntries'];
            $mealEntries[]=$day_params['lunchEntries'];
            $mealEntries[]=$day_params['dinnerEntries'];
            $total = 0;
        @endphp
        <div class="">
            {{ $date->format('d.m.Y')}}
        </div>
        <div class="week">
            @for ($i=0;$i<3;$i++)
                <div>
                    <h2>{{ $meals[$i] }}</h2>
                    <div class="meal">
                        @foreach ( $mealEntries[$i] as $entry )
                            <a href="{{ route('entries.edit', [
                                    'date' => $date->format('Y-m-d'),
                                    'meal' => 1,
                                    'entry' => $entry
                                ]) 
                            }}" > 
                            {{ $entry->product->name }}<br>
                            kkal: {{ $entry->weight * $entry->product->kkal/100 }}<br>
                            </a> 
                            @php $total = $entry->weight * $entry->product->kkal/100 @endphp
                        @endforeach
                        <a href="{{ route('entries.create', [
                                'date' => $date->format('Y-m-d'),
                                'meal' => 1
                            ]) 
                        }}" > Добавить новую запись</a> 
                    </div>
                </div>
            @endfor
     
            <div>
                Total kkal: {{ $total }}
            </div>
        </div>  
@endsection
