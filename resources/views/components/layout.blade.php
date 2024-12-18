<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
    <title>Cosmoport Timetable</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    {{--<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />--}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
  
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body style="font-family: Open Sans, sans-serif">
<div class="min-h-full">
    <nav>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img width="200" src="/images/logo-header.png" alt="CosmoPort Logo">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'statuses']) }}"
                                        class="text-gray-600 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-xl font-medium"
                            >
                                Dictionaries
                            </x-nav-link>
                            <x-nav-link href="/events"
                                        class="text-gray-600 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-xl font-medium"
                            >
                                Timetable
                            </x-nav-link>
                            <x-nav-link href="/events/gate/1"
                                        class="text-gray-600 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-xl font-medium"
                            >
                                Birthday Room
                            </x-nav-link>
                            <x-nav-link href="/events/gate/2"
                                        class="text-gray-600 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-xl font-medium"
                            >
                                Masterclass Room
                            </x-nav-link>
                            <x-nav-link href="/events/gate/3"
                                        class="text-gray-600 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-xl font-medium"
                            >
                                VR Pilot
                            </x-nav-link>
                            {{--<x-nav-link href="/events/get-all-for-today"--}}
                                        {{--class="text-gray-600 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-xl font-medium"--}}
                            {{-->--}}
                                {{--Timetable--}}
                            {{--</x-nav-link>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <x-message />
</div>
</body>
</html>




