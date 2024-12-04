<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Cosmoport Timetable</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ url('/css/gates.css') }}" media="all"/>
</head>

<body>
<div class="min-h-full">
    <div class="header">
        <div class="header__logo">
            <i class="i-logo header__logo-icon"></i>
        </div>
        <div class="header__info">
            <div class="flight__line" style="height: 5em !important; margin-right: 10px;">
                <div class="flight__line-title flight-title" style="width: 2em;">
                    <div class="flight-title__top"></div>
                    <div class="flight-title__name" style="padding-left: 0;">
                        <span class="material-symbols-outlined"
                              style="color: black; font-size: 1.5em; font-weight: bold; text-align: center;"
                        >schedule</span>
                    </div>
                    <div class="flight-title__bottom"></div>
                </div>
                <div class="flight__line-body" style="background-color: rgba(0, 0, 0, .5); padding-left: 0;">
                    <div id="current_time" class="flight__description-body"></div>
                </div>
                <div class="blue-line" style="width: 1em;">
                    <div class="blue-line-right-top"></div>
                    <div class="line-middle blue-line-middle"></div>
                    <div class="blue-line-right-bottom"></div>
                </div>
            </div>

            <div class="flight__line" style="height: 5em !important; margin-top: 0;">
                <div class="flight__line-title flight-title" style="width: 2em;">
                    <div class="flight-title__top"></div>
                    <div class="flight-title__name" style="padding-left: 0;">
                        <span class="material-symbols-outlined"
                              style="color: black; font-size: 1.5em; font-weight: bold; text-align: center;"
                        >calendar_month</span>
                    </div>
                    <div class="flight-title__bottom"></div>
                </div>
                <div class="flight__line-body" style="background-color: rgba(0, 0, 0, .5); padding-left: 0;">
                    <div id="current_date" class="flight__description-body"></div>
                </div>
                <div class="blue-line" style="width: 1em;">
                    <div class="blue-line-right-top"></div>
                    <div class="line-middle blue-line-middle"></div>
                    <div class="blue-line-right-bottom"></div>
                </div>
            </div>
        </div>
    </div>
    
    {{--<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">--}}
        {{--<div class="flex h-16 items-center justify-between">--}}
            {{--<div class="flex items-center">--}}
                {{--<div class="flex-shrink-0">--}}
                    {{--<img width="200" src="/images/logo-header.png" alt="CosmoPort Logo">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{ $slot }}
</div>

<script>
    function updateTime() {
        let now = new Date();

        let hours = now.getHours().toString().padStart(2, '0'),
            minutes = now.getMinutes().toString().padStart(2, '0');

        document.getElementById('current_time').innerText = `${hours}:${minutes}`;
    }

    function updateDate() {
        let today = new Date(),
            year = today.getFullYear(),
            month = today.toLocaleString('en', { month: 'long' }),
            day = today.getDate();

        document.getElementById('current_date').innerText = `${day} ${month} ${year}`;
    }

    setInterval(updateTime, 60000);
    setInterval(updateDate, 300000); // каждые 5 минут

    document.addEventListener('DOMContentLoaded', function () {
        updateTime();
        updateDate();
    });
</script>
</body>
</html>
