<x-dictionaries-main>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Settings</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-3xl py-6 sm:px-6 lg:px-8">
            <form action="/settings/pause" method="POST">
                @csrf
                @method('PUT')

                <div class="flex space-x-4">
                    <div class="w-2/3">
                        <p class="block text-m text-gray-700">
                            Начало/окончание обратного отсчёта для событий на гейтах.
                        </p>
                        <p class="block mb-2 text-m text-gray-700">
                            Не рекомендуется устанавливать значение меньше 5 минут.
                        </p>
                    </div>
                    <div class="w-1/3 grid grid-cols-2 gap-4">
                        <div>
                            <label>
                                <input id="pause" name="pause"
                                       class="border border-gray-400 p-2 w-full"
                                       type="number"
                                       min="0"
                                       value="{{ $pause->value }}"
                                >
                            </label>
                        </div>
                        <div style="text-align: right;">
                            <button type="submit"
                                    class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 uppercase"
                            >
                                Save
                            </button>
                        </div>
                    </div>

                    @error('pause')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </form>

            <hr class="mt-4 mb-6">

            <form action="/settings/timetable_screen_lines" method="POST">
                @csrf
                @method('PUT')

                <div class="flex space-x-4">
                    <div class="w-2/3">
                        <p class="block text-m text-gray-700">
                            Количество строк на экранах Timetable
                        </p>
                    </div>
                    <div class="w-1/3 grid grid-cols-2 gap-4">
                        <div>
                            <label>
                                <input class="border border-gray-400 p-2 w-full"
                                       id="timetable_screen_lines"
                                       name="timetable_screen_lines"
                                       type="number"
                                       min="0"
                                       value="{{ $timetable_screen_lines->value }}"
                                >
                            </label>
                        </div>
                        <div style="text-align: right;">
                            <button type="submit"
                                    class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 uppercase"
                            >
                                Save
                            </button>
                        </div>
                    </div>

                    @error('timetable_screen_lines')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </form>

            <hr class="mt-4 mb-6">

            <form action="/locales/update-all" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <p class="block text-m text-gray-700 mb-4">
                        Длительность показа переводов на используемых языках в минутах.
                    </p>

                    <div>
                        @foreach($locales as $locale)
                            <div class="grid grid-cols-3 gap-4 mt-2 mb-4">
                                <div style="text-align: right;">
                                    <h4 class="block mt-3 text-m uppercase font-bold text-gray-700">{{ $locale->description }}</h4>
                                </div>
                                <div>
                                    <label for="show_time_{{ $locale->id }}"></label>
                                    <input id="show_time_{{ $locale->id }}" name="locales[{{ $locale->id }}][show_time]"
                                           class="border border-gray-400 p-2 w-full"
                                           type="number"
                                           value="{{ old('locales.' . $locale->id . '.show_time', $locale->show_time) }}"
                                           required
                                    >
                                    <span class="block mb-2 text-xs uppercase font-bold text-gray-700">Show Time</span>
                                </div>
                                <div>
                                    <input id="is_default_{{ $locale->id }}" name="locales[{{ $locale->id }}][is_default]"
                                           class="form-check-input" {{ $locale->is_default ? 'checked' : '' }}
                                           type="checkbox"
                                    >
                                    <label for="is_default_{{ $locale->id }}" class="block mb-2 text-xs uppercase font-bold text-gray-700">Is Default</label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div style="text-align: right;">
                        <button type="submit"
                                class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 uppercase"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </form>

            <hr class="mt-4">
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const locales = @json($locales);
            const pause = @json($pause);
            const timetable_screen_lines = @json($timetable_screen_lines);
            console.log(locales);
            console.log(pause);
            console.log(timetable_screen_lines);

            // document.getElementById('save_pause').addEventListener('click', function () {
            //     console.log('save_pause');
            // });
            //
            // document.getElementById('save_lines').addEventListener('click', function () {
            //     console.log('save_lines');
            // });
            //
            // document.getElementById('save_locales').addEventListener('click', function () {
            //     console.log('save_locales');
            // });
        });
    </script>
</x-dictionaries-main>
