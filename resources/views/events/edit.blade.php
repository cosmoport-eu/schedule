<x-layout>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Edit Event</h1>
        </div>
    </header>

    <main>
        <div class="max-w-2xl mx-auto mt-10 mb-10 bg-gray-200 border border-gray-300 p-6 rounded-xl">
            <form action="/events/{{ $event->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
                    <a href="/events" class="text-blue-500 text-xl font-semibold hover:underline">
                        Back
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-3 text-xs uppercase font-bold text-gray-700" for="category_id">Category</label>

                        <select class="border border-gray-400 p-2 w-full"
                                name="category_id"
                                id="category_id"
                                required
                        >
                            <option value="">Select Category</option>

                            @if (isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->i18n_name_code }}"
                                        {{ $event->typeEn->i18n_category_code == $category->i18n_name_code ? 'selected' : '' }}
                                    >
                                        {{ $category->translationEn->text }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label class="block mb-3 text-xs uppercase font-bold text-gray-700" for="type_id">Type</label>

                        <select class="border border-gray-400 p-2 w-full"
                                name="type_id"
                                id="type_id"
                                required
                        >
                            <option value="">Select Type</option>
                            @foreach ($event->typeEn->categoryEn->typesEn as $type)
                                <option value="{{ $type->id }}"
                                    {{ $event->type_id == $type->id || $event->typeEn->parent_id == $type->id ? 'selected' : '' }}
                                >
                                    {{ $type->nameTranslationEn->text }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-3 text-xs uppercase font-bold text-gray-700" for="subtype_id">Subtype/Lesson</label>

                        <select id="subtype_id"
                                name="subtype_id"
                                class="border border-gray-400 p-2 w-full"
                        >
                            <option value="">Select Subtype/Lesson</option>
                            @if ($event->typeEn->parent_id)
                                @foreach ($event->typeEn->parent->subtypesEn as $subtype)
                                    <option value="{{ $subtype->id }}" {{ $event->type_id == $subtype->id ? 'selected' : '' }}>
                                        {{ $subtype->nameTranslationEn->text }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        {{--
                            пока мероприятия проводятся в одном помещении, нет смысла выбирать два гейта
                            поэтому departure = arrival
                        --}}
                        <label for="gate_id" class="block mb-3 text-xs uppercase font-bold text-gray-700">Gate</label>

                        <select id="gate_id"
                                name="gate_id"
                                class="border border-gray-400 p-2 w-full"
                                required
                        >
                            <option value="">Gate</option>

                            @if (isset($gates))
                                @foreach($gates as $gate)
                                    <option value="{{ $gate->id }}"
                                        {{ $event->departure_gate_id == $gate->id ? 'selected' : '' }}
                                    >{{ $gate->translationEn->text }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="destination_id" class="block mb-3 text-xs uppercase font-bold text-gray-700">Destination</label>

                        <select id="destination_id"
                                name="destination_id"
                                class="border border-gray-400 p-2 w-full"
                        >
                            <option value="">Destination</option>

                            @if (isset($destinations))
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}"
                                        {{ $event->destination_id == $destination->id ? 'selected' : '' }}
                                    >{{ $destination->translationEn->text }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="status_id" class="block mb-3 text-xs uppercase font-bold text-gray-700">Status</label>

                        <select id="status_id"
                                name="status_id"
                                class="border border-gray-400 p-2 w-full"
                                required
                        >
                            <option value="">Choose Status</option>

                            @if (isset($statuses))
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $event->status_id == $status->id ? 'selected' : '' }}
                                    >{{ $status->translationEn->text }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="w-1/4">
                        <label class="block mb-3 text-xs uppercase font-bold text-gray-700" for="date">Date</label>

                        <input id="date" name="date"
                            datepicker datepicker-autohide
                            type="text"
                            class="border border-gray-400 p-2 w-full"
                            value="{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}"
                            placeholder="Select date"
                            required
                        >
                    </div>
                    <div class="w-1/4">
                        <label for="time_start" class="block mb-3 text-xs uppercase font-bold text-gray-700">Start Time</label>

                        <input id="time_start" name="time_start"
                               type="time"
                               class="border border-gray-400 p-2 w-full"
                               value="{{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }}"
                               required
                        >
                    </div>
                    <div class="w-1/4">
                        <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="duration">Duration</label>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mt-1">
                                <input class="border border-gray-400 p-2 w-full"
                                       id="duration_hours"
                                       name="duration_hours"
                                       type="number"
                                       min="0" max="23"
                                       value="{{ intdiv($event->duration, 60) }}"
                                >
                                <span class="block mb-2 text-xs uppercase font-bold text-gray-700">hours</span>
                            </div>
                            <div class="mt-1">
                                <input class="border border-gray-400 p-2 w-full"
                                       id="duration_minutes"
                                       name="duration_minutes"
                                       type="number"
                                       min="0" max="59"
                                       value="{{ $event->duration % 60 }}"
                                >
                                <span class="block mb-2 text-xs uppercase font-bold text-gray-700">minutes</span>
                            </div>
                        </div>

                        @error('duration')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-1/4 grid grid-cols-2 gap-4">
                        <div class="mt-1">
                            <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="cost">Cost</label>

                            <input class="border border-gray-400 p-2 w-full"
                                   id="cost"
                                   name="cost"
                                   type="number"
                                   step="1" min="0"
                                   value="{{ $event->cost }}"
                            >

                            @error('cost')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-1">
                            <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="people_limit">People</label>

                            <input class="border border-gray-400 p-2 w-full"
                                   id="people_limit"
                                   name="people_limit"
                                   type="number"
                                   value="{{ $event->people_limit }}"
                                   step="1" min="0"
                            >

                            @error('people_limit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="description">
                        Description
                    </label>

                    <div class="mb-6 mt-1">
                        <p class="block mb-2 text-xs uppercase font-bold text-red-500">
                            For Birthday: kid name and age
                        </p>
                    </div>

                    <textarea class="border border-gray-400 p-2 w-full"
                              id="description"
                              name="description"
                    >{{ $event->description }}</textarea>

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
                <x-has_error />

                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
                    <a href="/events" class="text-blue-500 text-xl font-semibold hover:underline">
                        Back
                    </a>

                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 uppercase"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categories = @json($categories);

            const categorySelect = document.getElementById('category_id');
            const typeSelect = document.getElementById('type_id');
            const subtypeSelect = document.getElementById('subtype_id');

            categorySelect.addEventListener('change', function () {
                const categoryCode = this.value;

                typeSelect.innerHTML = '<option value="">Select Type</option>';
                subtypeSelect.innerHTML = '<option value="">Select Subtype/Lesson</option>';

                if (categoryCode) {
                    const selectedCategory = categories.find(category => category.i18n_name_code == categoryCode);

                    selectedCategory.types_en.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.id;
                        option.textContent = type.name_translation_en.text;
                        typeSelect.appendChild(option);
                    });
                }
            });

            typeSelect.addEventListener('change', function () {
                const categoryCode = categorySelect.value;
                const typeCode = this.value;

                subtypeSelect.innerHTML = '<option value="">Select Subtype/Lesson</option>';

                if (categoryCode && typeCode) {
                    const selectedCategory = categories.find(category => category.i18n_name_code == categoryCode);
                    const selectedType = selectedCategory.types_en.find(type => type.id == typeCode);

                    if (selectedType && selectedType.subtypes_en) {
                        selectedType.subtypes_en.forEach(subtype => {
                            const option = document.createElement('option');
                            option.value = subtype.id;
                            option.textContent = subtype.name_translation_en.text;
                            subtypeSelect.appendChild(option);
                        });
                    }
                }
            });
        });
    </script>
</x-layout>
