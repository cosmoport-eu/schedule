<x-layout>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="mx-auto max-w-7xl">
                        <h1 class="text-3xl font-bold tracking-tight text-white">Dictionaries</h1>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'interface-elements']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Interface elements
                            </x-nav-link>

                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'statuses']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Statuses
                            </x-nav-link>

                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'gates']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Gates
                            </x-nav-link>

                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'destinations']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Destinations
                            </x-nav-link>

                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'facilities']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Facilities
                            </x-nav-link>

                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'materials']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Materials
                            </x-nav-link>

                            <x-nav-link href="{{ route('dictionary.index', ['type' => 'categories']) }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Categories
                            </x-nav-link>

                            <x-nav-link href="{{ route('types.index') }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Types
                            </x-nav-link>

                            <x-nav-link href="{{ route('settings.index') }}"
                                        class="rounded-md px-3 py-2 text-m font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                            >
                                Settings
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}
</x-layout>
