@extends('layouts.app')

@section('forms')
    <form action="{{ route('show.week') }}" method="post" class="btn">
            @csrf
            <input type="week" name="week" 
            class="px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            onchange="this.form.submit()">
    </form>
@endsection
        
@section('data_on_days')


    @if(isset($selectedWeek))
        <div class="week">
                @php
                    $start = new DateTime($weekStart);
                    $week_days=['Monday', 'Tuesday', 'Wednesday', 'Thursday','Friday','Sunday','Saturday'];
                    //$breakastData= $entries->where('date',$start)->where('meal.name','breakfast')->pluck('product.name')
                @endphp
                @for ($i=0; $i<7; $i++)
                    <a href="{{ route('show.day', ['day'=>$start->format('d.m.Y')]) }}" class="block week_day">
                        @php
                            //ENTRIES FOR THE DAY
                            $data= $entries->where('date',$start->format('Y-m-d'));
                        @endphp  
                        <h2 class="week_day_title">{{ $week_days[$i] }}</h2>
                        <h2 class="date">{{ $start->format('d.m.Y') }}</h2>
                        <div class="h-5/6">
                            <div class="meal">
                                @php
                                    $breakfastEntries= $data->filter(function($entry) {
                                        return $entry->meal->name == 'breakfast';
                                    })
                                @endphp  
                                @foreach ( $breakfastEntries as $item )
                                    {{ $item->product->name }}<br>
                                    kkal: {{ $item->weight * $item->product->kkal/100 }}<br>                                @endforeach
                            </div>
                            <div class="meal">
                                @php
                                    $lunchEntries= $data->filter(function($entry) {
                                        return $entry->meal->name == 'lunch';
                                    })
                                @endphp  
                                @foreach ( $lunchEntries as $item )
                                    {{ $item->product->name }}<br>
                                    kkal: {{ $item->weight * $item->product->kkal/100 }}<br>
                                @endforeach                          
                            </div>
                            <div class="meal">
                                @php
                                    $dinnerEntries= $data->filter(function($entry) {
                                        return $entry->meal->name == 'dinner';
                                    })
                                @endphp  
                                @foreach ( $dinnerEntries as $item )
                                    {{ $item->product->name }}<br>
                                    kkal: {{ $item->weight * $item->product->kkal/100 }}<br>
                                @endforeach                   
                            </div>
                        </div>
                    </a>
                    @php
                        $start -> add(new DateInterval("P1D"))
                    @endphp
                @endfor
        </div> 
    @endif 
@endsection
        
