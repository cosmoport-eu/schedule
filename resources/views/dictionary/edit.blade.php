<x-dictionaries-main>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Edit {{ $type }}</h1>
        </div>
    </header>

    <main>
        <div class="max-w-lg mx-auto mt-10 bg-gray-200 border border-gray-300 p-6 rounded-xl">
            <form action="{{ route('dictionary.update', ['type' => $type, 'id' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6 mt-1">
                    <p class="text-xl">
                        You can change record later here or in a Translations directory.
                    </p>
                </div>

                @if($is_icon_needed)
                    <div class="mb-6">
                        <p class="text-l mt-1">
                            Choose an icon
                            <a class="text-blue-700"
                               style="font-weight: bold;"
                               href="https://fonts.google.com/icons?icon.set=Material+Symbols"
                               target="_blank"
                            >
                                on the site
                            </a>
                        </p>

                        <label class="block mb-2 uppercase font-bold text-gray-700"
                               for="icon"
                        >
                            Icon name
                        </label>

                        <input class="border border-gray-400 p-2 w-full"
                               id="icon"
                               name="icon"
                               type="text"
                               value="{{ $item->icon }}"
                        >

                        @error('icon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="mb-6 mt-1">
                    <p class="text-xl text-red-500">
                        Enter the value at least for one language.
                    </p>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-gray-700"
                           for="english"
                    >
                        English
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           id="english"
                           name="english"
                           type="text"
                           value="{{ $item->translationEn->text }}"
                    >

                    @error('english')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-gray-700"
                           for="russian"
                    >
                        Russian
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           id="russian"
                           name="russian"
                           type="text"
                           value="{{ $item->translationRu->text }}"
                    >

                    @error('russian')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-gray-700"
                           for="greek"
                    >
                        Greek
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           id="greek"
                           name="greek"
                           type="text"
                           value="{{ $item->translationGr->text }}"
                    >

                    @error('greek')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-has_error />

                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
                    <a href="{{ route('dictionary.index', ['type' => $type]) }}" class="text-blue-500 text-xl font-semibold hover:underline">
                        Back
                    </a>

                    @if (!session()->has('success'))
                        <button type="submit"
                                class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 uppercase"
                        >
                            Save
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </main>
</x-dictionaries-main>
