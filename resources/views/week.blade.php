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
                $total = 0;
            @endphp
            @for ($i=0; $i<7; $i++)
                <form action="{{ route( 'show.day') }}" method="get" class="block week_day">
                    @php
                        //ENTRIES FOR THE DAY
                        $breakfast= $breakfastEntries->where('date',$start->format('Y-m-d'));
                        $lunch= $lunchEntries->where('date',$start->format('Y-m-d'));
                        $dinner= $dinnerEntries->where('date',$start->format('Y-m-d'));
                        $dayEntries=[];
                        $dayEntries[]=$breakfastEntries->where('date',$start->format('Y-m-d'));
                        $dayEntries[]=$lunch;
                        $dayEntries[]=$dinner;
                    @endphp
                    <input type="hidden" name="date" value="{{ $start->format('Y-m-d') }}">
                    <button type="submit" class="block week_day">
                    <h2 class="week_day_title">{{ $week_days[$i] }}</h2>
                    <h2 class="date">{{ $start->format('d.m.Y') }}</h2>
                    <div class="h-5/6">
                        @foreach ($dayEntries as $meal)
                            <div class="meal">
                            @foreach ($meal as $item)
                                    {{ $item->product->name }}<br>
                                    kkal: {{ $item->weight * $item->product->kkal/100 }}<br>
                                    @php $total = $item->weight * $item->product->kkal/100 @endphp
                            @endforeach
                            </div>
                        @endforeach
                        <div>
                            Total kkal: {{ $total }}
                        </div>
                    </div>  
                    </button>
                </form>
                @php
                    $start -> add(new DateInterval("P1D"))
                @endphp
            @endfor
        </div> 
    @endif 
@endsection
        
                        