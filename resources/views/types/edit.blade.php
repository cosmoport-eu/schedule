<x-dictionaries-main>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Edit Type</h1>
        </div>
    </header>

    <main>
        <div class="max-w-2xl mx-auto mt-10 mb-10 bg-gray-200 border border-gray-300 p-6 rounded-xl">
            <form action="/types/{{ $type->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
                    <a href="/types" class="text-blue-500 text-xl font-semibold hover:underline">
                        Back
                    </a>
                </div>

                <div class="mb-6 mt-1">
                    <p class="text-xl">
                        You can change record later here or in a Translations directory.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-3 text-xs uppercase font-bold text-gray-700" for="i18n_category_code">Category</label>

                        <select class="border border-gray-400 p-2 w-full"
                                name="i18n_category_code"
                                id="i18n_category_code"
                                required
                        >
                            <option value="">Category</option>

                            @if (isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->translationEn->code }}"
                                        {{ $type->i18n_category_code == $category->translationEn->code ? 'selected' : '' }}
                                    >{{ $category->translationEn->text }}</option>
                                @endforeach
                            @endif
                        </select>

                        @error('i18n_category_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="name">Name</label>

                        <input class="border border-gray-400 p-2 w-full"
                               id="name"
                               name="name"
                               type="text"
                               value="{{ $type->nameTranslationEn->text }}"
                        >

                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="description">Description</label>

                    <textarea class="border border-gray-400 p-2 w-full"
                              id="description"
                              name="description"
                    >{{ $type->descrTranslationEn->text }}</textarea>

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="main_type_additional_block">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="default_duration">Duration</label>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <input class="border border-gray-400 p-2 w-full"
                                           id="default_duration_hours"
                                           name="default_duration_hours"
                                           type="number"
                                           value="{{ intdiv($type->default_duration, 60) }}"
                                    >
                                    <span class="block mb-2 text-xs uppercase font-bold text-gray-700">hours</span>
                                </div>
                                <div>
                                    <input class="border border-gray-400 p-2 w-full"
                                           id="default_duration_minutes"
                                           name="default_duration_minutes"
                                           type="number"
                                           value="{{ $type->default_duration % 60 }}"
                                    >
                                    <span class="block mb-2 text-xs uppercase font-bold text-gray-700">minutes</span>
                                </div>
                            </div>

                            @error('default_duration')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="default_cost">Cost</label>

                            <div class="relative">
                                <input class="border border-gray-400 p-2 pl-7 pr-12 w-full"
                                       id="default_cost"
                                       name="default_cost"
                                       type="number"
                                       value="{{ $type->default_cost }}" step="0.01" min="0"
                                >
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">€</span>
                                </div>
                            </div>

                            @error('default_cost')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="default_participants_number">Participants number</label>

                            <input class="border border-gray-400 p-2 w-full"
                                   id="default_participants_number"
                                   name="default_participants_number"
                                   type="number"
                                   value="{{ $type->default_participants_number }}"
                            >

                            @error('default_participants_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="grid grid-cols-2 gap-4 mb-4">--}}
                        {{--<div>--}}
                            {{--<label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="material_ids">Materials</label>--}}

                            {{--<select class="border border-gray-400 p-2 w-full"--}}
                                    {{--id="material_ids"--}}
                                    {{--name="material_ids[]"--}}
                                    {{--multiple="multiple"--}}
                            {{-->--}}
                                {{--<option value="" selected>Select Materials (optional)</option>--}}
                                {{--@if (isset($materials))--}}
                                    {{--@foreach($materials as $material)--}}
                                        {{--<option value="{{ $material->id }}"--}}
                                                {{--{{ in_array($material->id, $type->materials->pluck('id')->toArray()) ? 'selected' : '' }}--}}
                                        {{-->--}}
                                            {{--{{ $material->translationEn->text }}--}}
                                        {{--</option>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</select>--}}

                            {{--@error('material_ids')--}}
                            {{--<p class="text-red-500 text-xs mt-1">{{ $message }}</p>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="facility_ids">Facilities</label>--}}

                            {{--<select class="border border-gray-400 p-2 w-full"--}}
                                    {{--id="facility_ids"--}}
                                    {{--name="facility_ids[]"--}}
                                    {{--multiple--}}
                                    {{--required--}}
                            {{-->--}}
                                {{--<option value="" selected>Select Facilities</option>--}}
                                {{--@if (isset($facilities))--}}
                                    {{--@foreach($facilities as $facility)--}}
                                        {{--<option value="{{ $facility->id }}"--}}
                                            {{--{{ in_array($facility->id, $type->facilities->pluck('id')->toArray()) ? 'selected' : '' }}--}}
                                        {{-->--}}
                                            {{--{{ $facility->translationEn->text }}--}}
                                        {{--</option>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</select>--}}

                            {{--@error('facility_ids')--}}
                            {{--<p class="text-red-500 text-xs mt-1">{{ $message }}</p>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

                <div id="subtypes_container">
                    @if ($type->subtypesEn->isNotEmpty())
                        @foreach ($type->subtypesEn as $subtype)
                            <div class="border-t border-gray-800 pt-4 mt-6 subtype-block">
                                <input type="hidden" name="subtypes[{{ $loop->index }}][id]" value="{{ $subtype->id }}">

                                <div class="flex items-center justify-center space-x-4 mb-4">
                                    <div class="w-4/5">
                                        <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][name]">Name</label>

                                        <input class="border border-gray-400 p-2 w-full"
                                               id="subtypes[{{ $loop->index }}][name]"
                                               name="subtypes[{{ $loop->index }}][name]"
                                               type="text"
                                               value="{{ $subtype->nameTranslationEn->text }}"
                                        >

                                        @error('subtypes[{{ $loop->index }}][name]')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="w-1/5">
                                        <button type="button"
                                                class="remove-subtype bg-red-400 text-white rounded py-2 px-4 hover:bg-red-500 uppercase"
                                                style="margin-top: 1.5rem;"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][description]">Description</label>

                                    <textarea class="border border-gray-400 p-2 w-full"
                                              id="subtypes[{{ $loop->index }}][description]"
                                              name="subtypes[{{ $loop->index }}][description]"
                                    >{{ $subtype->descrTranslationEn->text }}</textarea>

                                    @error('subtypes[{{ $loop->index }}][description]')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][default_duration]">Duration</label>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <input class="border border-gray-400 p-2 w-full"
                                                       id="subtypes[{{ $loop->index }}][default_duration_hours]"
                                                       name="subtypes[{{ $loop->index }}][default_duration_hours]"
                                                       type="number"
                                                       value="{{ intdiv($subtype->default_duration, 60) }}"
                                                >
                                                <span class="block mb-2 text-xs uppercase font-bold text-gray-700">hours</span>
                                            </div>
                                            <div>
                                                <input class="border border-gray-400 p-2 w-full"
                                                       id="subtypes[{{ $loop->index }}][default_duration_minutes]"
                                                       name="subtypes[{{ $loop->index }}][default_duration_minutes]"
                                                       type="number"
                                                       value="{{ $subtype->default_duration % 60 }}"
                                                >
                                                <span class="block mb-2 text-xs uppercase font-bold text-gray-700">minutes</span>
                                            </div>
                                        </div>

                                        @error('subtypes[{{ $loop->index }}][default_duration]')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][default_cost]">Cost</label>

                                        <div class="relative">
                                            <input class="border border-gray-400 p-2 pl-7 pr-12 w-full"
                                                   id="subtypes[{{ $loop->index }}][default_cost]"
                                                   name="subtypes[{{ $loop->index }}][default_cost]"
                                                   type="number"
                                                   value="{{ $subtype->default_cost }}" step="0.01" min="0"
                                            >
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">€</span>
                                            </div>
                                        </div>

                                        @error('subtypes[{{ $loop->index }}][default_cost]')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][default_participants_number]">Participants number</label>

                                        <input class="border border-gray-400 p-2 w-full"
                                               id="subtypes[{{ $loop->index }}][default_participants_number]"
                                               name="subtypes[{{ $loop->index }}][default_participants_number]"
                                               type="number"
                                               value="{{ $subtype->default_participants_number }}"
                                        >

                                        @error('subtypes[{{ $loop->index }}][default_participants_number]')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                {{--<div class="grid grid-cols-2 gap-4 mb-4">--}}
                                    {{--<div>--}}
                                        {{--<label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][material_ids]">Materials</label>--}}

                                        {{--<select class="border border-gray-400 p-2 w-full"--}}
                                                {{--id="subtypes[{{ $loop->index }}][material_ids]"--}}
                                                {{--name="subtypes[{{ $loop->index }}][material_ids][]"--}}
                                                {{--multiple="multiple"--}}
                                        {{-->--}}
                                            {{--<option value="" selected>Select Materials (optional)</option>--}}
                                            {{--@if (isset($materials))--}}
                                                {{--@foreach($materials as $material)--}}
                                                    {{--<option value="{{ $material->id }}"--}}
                                                        {{--{{ in_array($material->id, $subtype->materials->pluck('id')->toArray()) ? 'selected' : '' }}--}}
                                                    {{-->--}}
                                                        {{--{{ $material->translationEn->text }}--}}
                                                    {{--</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}

                                        {{--@error('subtypes[{{ $loop->index }}][material_ids]')--}}
                                        {{--<p class="text-red-500 text-xs mt-1">{{ $message }}</p>--}}
                                        {{--@enderror--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--<label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[{{ $loop->index }}][facility_ids]">Facilities</label>--}}

                                        {{--<select class="border border-gray-400 p-2 w-full"--}}
                                                {{--id="subtypes[{{ $loop->index }}][facility_ids]"--}}
                                                {{--name="subtypes[{{ $loop->index }}][facility_ids][]"--}}
                                                {{--multiple--}}
                                                {{--required--}}
                                        {{-->--}}
                                            {{--<option value="" selected>Select Facilities</option>--}}
                                            {{--@if (isset($facilities))--}}
                                                {{--@foreach($facilities as $facility)--}}
                                                    {{--<option value="{{ $facility->id }}"--}}
                                                        {{--{{ in_array($facility->id, $subtype->facilities->pluck('id')->toArray()) ? 'selected' : '' }}--}}
                                                    {{-->--}}
                                                        {{--{{ $facility->translationEn->text }}--}}
                                                    {{--</option>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</select>--}}

                                        {{--@error('subtypes[{{ $loop->index }}][facility_ids]')--}}
                                        {{--<p class="text-red-500 text-xs mt-1">{{ $message }}</p>--}}
                                        {{--@enderror--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        @endforeach
                    @endif
                </div>

                <button id="add_subtype_btn" type="button"
                        class="bg-gray-400 text-white rounded py-2 px-4 hover:bg-gray-500 uppercase"
                >
                    Add Subtype
                </button>
                
                <x-has_error />

                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
                    <a href="/types" class="text-blue-500 text-xl font-semibold hover:underline">
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
            const subtypesEn = @json($type->subtypesEn);
            console.log(@json($type));

            let subtypeIndex = subtypesEn.length;
            const $subtypeContainer = document.getElementById('subtypes_container');

            if (subtypesEn.length > 0) {
                document.getElementById('main_type_additional_block').classList.add('hidden');
            }

            document.getElementById('add_subtype_btn').addEventListener('click', function () {
                const $newBlock = document.createElement('div');

                if (!document.getElementById('main_type_additional_block').classList.contains('hidden')) {
                    document.getElementById('main_type_additional_block').classList.add('hidden');
                }

                $newBlock.classList.add('subtype-block');
                $newBlock.classList.add('mt-10');
                $newBlock.setAttribute('data-index', subtypeIndex);

                $newBlock.innerHTML = `
                    <div class="border-t border-gray-800 pt-4 mt-6">
                        <div class="flex items-center justify-center space-x-4 mb-4">
                            <div class="w-4/5">
                                <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][name]">Name</label>

                                <input class="border border-gray-400 p-2 w-full"
                                       id="subtypes[${subtypeIndex}][name]"
                                       name="subtypes[${subtypeIndex}][name]"
                                       type="text"
                                >
                            </div>
                            <div class="w-1/5">
                                <button type="button"
                                        class="remove-subtype bg-red-400 text-white rounded py-2 px-4 hover:bg-red-500 uppercase"
                                        style="margin-top: 1.5rem;"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][description]">Description</label>

                            <textarea class="border border-gray-400 p-2 w-full"
                                      id="subtypes[${subtypeIndex}][description]"
                                      name="subtypes[${subtypeIndex}][description]"
                            ></textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][default_duration]">Duration</label>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <input class="border border-gray-400 p-2 w-full"
                                               id="subtypes[${subtypeIndex}][default_duration_hours]"
                                               name="subtypes[${subtypeIndex}][default_duration_hours]"
                                               type="number"
                                               value="0"
                                        >
                                        <span class="block mb-2 text-xs uppercase font-bold text-gray-700">hours</span>
                                    </div>
                                    <div>
                                        <input class="border border-gray-400 p-2 w-full"
                                               id="subtypes[${subtypeIndex}][default_duration_minutes]"
                                               name="subtypes[${subtypeIndex}][default_duration_minutes]"
                                               type="number"
                                               value="0"
                                        >
                                        <span class="block mb-2 text-xs uppercase font-bold text-gray-700">minutes</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][default_cost]">Cost</label>

                                <div class="relative">
                                    <input class="border border-gray-400 p-2 pl-7 pr-12 w-full"
                                           id="subtypes[${subtypeIndex}][default_cost]"
                                           name="subtypes[${subtypeIndex}][default_cost]"
                                           type="number"
                                           value="0" step="0.01" min="0"
                                    >
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][default_participants_number]">Participants number</label>

                                <input class="border border-gray-400 p-2 w-full"
                                       id="subtypes[${subtypeIndex}][default_participants_number]"
                                       name="subtypes[${subtypeIndex}][default_participants_number]"
                                       type="number"
                                       value="0"
                                >
                            </div>
                        </div>
                        {{--<div class="grid grid-cols-2 gap-4 mb-4">--}}
                            {{--<div>--}}
                                {{--<label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][material_ids]">Materials</label>--}}

                                {{--<select class="border border-gray-400 p-2 w-full"--}}
                                        {{--id="subtypes[${subtypeIndex}][material_ids]"--}}
                                        {{--name="subtypes[${subtypeIndex}][material_ids][]"--}}
                                        {{--multiple="multiple"--}}
                                {{-->--}}
                                    {{--<option value="" selected>Select Materials (optional)</option>--}}
                                    {{--@if (isset($materials))--}}
                                        {{--@foreach($materials as $material)--}}
                                        {{--<option value="{{ $material->id }}">{{ $material->translationEn->text }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                            {{--</select>--}}
                            {{--</div>--}}

                            {{--<div>--}}
                                {{--<label class="block mb-2 text-xs uppercase font-bold text-gray-700" for="subtypes[${subtypeIndex}][facility_ids]">Facilities</label>--}}

                                {{--<select class="border border-gray-400 p-2 w-full"--}}
                                        {{--id="subtypes[${subtypeIndex}][facility_ids]"--}}
                                        {{--name="subtypes[${subtypeIndex}][facility_ids][]"--}}
                                        {{--multiple--}}
                                        {{--required--}}
                                {{-->--}}
                                    {{--<option value="" selected>Select Facilities</option>--}}
                                    {{--@if (isset($facilities))--}}
                                        {{--@foreach($facilities as $facility)--}}
                                        {{--<option value="{{ $facility->id }}">{{ $facility->translationEn->text }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                `;

                $subtypeContainer.appendChild($newBlock);
                subtypeIndex++;
            });

            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-subtype')) {
                    event.target.closest('.subtype-block').remove();

                    if ($subtypeContainer.childNodes.length === 0) {
                        document.getElementById('main_type_additional_block').classList.remove('hidden');
                    }
                }
            });
        });
    </script>
</x-dictionaries-main>
