<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="h-screen">
        
        <form action="{{ route('show.week') }}" method="post" class="btn">
            @csrf
            <input type="week" name="week" 
            class="px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            onchange="this.form.submit()">
        </form>

        <div class="week">
            @if(session('selectedWeek'))
                @php
                    $start = new DateTime(session('weekStart'));
                    $week_days=['Monday', 'Tuesday', 'Wednesday', 'Thursday','Friday','Sunday','Saturnday'];
                @endphp
                @for ($i=0; $i<7; $i++)
                    <a href="{{ route('show.day', ['day'=>$start->format('d.m.Y')]) }}" class="block week_day">
                        <h2 class="week_day_title">{{ $week_days[$i] }}</h2>
                        <h2 class="date">{{ $start->format('d.m.Y') }}</h2>
                        <div class="h-5/6">
                            <div class="meal">
                                Завтрак
                            </div>
                            <div class="meal">
                                Обед
                            </div>
                            <div class="meal">
                                Ужин
                            </div>
                        </div>
                    </a>
                    @php
                        $start -> add(new DateInterval("P1D"))
                    @endphp
                @endfor
            @endif
        </div>  
    </body>
</html>
