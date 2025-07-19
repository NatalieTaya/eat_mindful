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
            <input type="week" name="week">
           <button type="submit">Отправить</button>
        </form>

        <div class="week">
                @php
                    $meals=['Завтрак', 'Обед', 'Ужин', 'Перекус'];
                    $start = new DateTime(session('weekStart'))
                @endphp
                <div class="">
                    {{ $start->format('d.m.Y') }}
                </div>
                @for ($i=0; $i<4; $i++)
                    <a href="{{ route('show.date') }}" class="block week_day">
                        <h2>{{ $meals[$i] }}</h2>
                    </a>
                @endfor
            
        </div>  
    </body>
</html>
