<x-layout>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Events</h1>

            <a href="/events/create"
               type="button"
               class="py-2.5 px-5 ml-16 mb-2 mt-2 text-xl font-medium text-gray-900 focus:outline-none
                bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700
                focus:z-10 focus:ring-4 focus:ring-gray-200
                uppercase font-semibold"
            >add</a>
        </div>
    </header>

    <main>
        <form method="POST" action="/events/get-filtered">
            @csrf

            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 flex space-x-4 mb-4">
                <div class="flex space-x-4 mb-4" date-rangepicker>
                    <div class="w-1/2 relative">
                        <label for="date_start"
                               class="block mb-3 text-xs uppercase font-bold text-gray-700"
                        >
                            Date Start
                        </label>
                        <input id="date_start" name="date_start"
                               type="text"
                               class="border border-gray-400 p-2 w-full"
                               value="{{ isset($filters['date_start']) ? \Carbon\Carbon::parse($filters['date_start'])->format('m/d/Y') : \Carbon\Carbon::now()->format('m/d/Y') }}"
                               placeholder="Select date start"
                               required
                        >
                    </div>
                    <div class="w-1/2 relative">
                        <label for="date_end"
                               class="block mb-3 text-xs uppercase font-bold text-gray-700"
                        >
                            Date End
                        </label>
                        <input id="date_end" name="date_end"
                               type="text"
                               class="border border-gray-400 p-2 w-full"
                               value="{{ isset($filters['date_end']) ? \Carbon\Carbon::parse($filters['date_end'])->format('m/d/Y') : \Carbon\Carbon::now()->addDays(7)->format('m/d/Y') }}"
                               placeholder="Select date end"
                               required
                        >
                    </div>
                </div>
                <div class="w-1/4">
                    <label for="status_id"
                           class="block mb-3 text-xs uppercase font-bold text-gray-700"
                    >
                        Statuses
                    </label>

                    <select id="status_id"
                            name="status_id[]"
                            class="border border-gray-400 p-2 w-full"
                            multiple
                            required
                    >
                        @if (isset($statuses))
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ isset($filters['status_id']) ? (in_array($status->id, $filters['status_id']) ? 'selected' : '') : 'selected' }}
                                >{{ $status->translationEn->text }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="w-1/4">
                    <label for="destination_id"
                           class="block mb-3 text-xs uppercase font-bold text-gray-700"
                    >
                        Destinations
                    </label>

                    <select id="destination_id"
                            name="destination_id[]"
                            class="border border-gray-400 p-2 w-full"
                            multiple
                            required
                    >
                        <option value="0"
                            {{ isset($filters['destination_id']) ? (in_array('0', $filters['destination_id']) ? 'selected' : '') : 'selected' }}
                        >No destination yet</option>
                        @if (isset($destinations))
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}"
                                    {{ isset($filters['destination_id']) ? (in_array($destination->id, $filters['destination_id']) ? 'selected' : '') : 'selected' }}
                                >{{ $destination->translationEn->text }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="w-1/4">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 uppercase">
                        update
                    </button>
                </div>
            </div>
        </form>

        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
                <table class="w-full text-lg text-center text-gray-500">
                    <thead class="text-gray-700 uppercase bg-gray-50">
                    <tr class="font-bold">
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Time</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Type</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Gate</th>
                        <th scope="col" class="px-6 py-3">Destination</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $item->id }}</td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->date }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->time_end)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4">{{ $item->typeEn->categoryEn->translationEn->text }}</td>
                            <td class="px-6 py-4">{{ $item->typeEn->nameTranslationEn->text }}</td>
                            <td class="px-6 py-4">{{ $item->statusEn->translationEn->text }}</td>
                            <td class="px-6 py-4">{{ $item->departureGateEn->translationEn->text }}</td>
                            <td class="px-6 py-4">{{ is_null($item->destinationEn) ? '' : $item->destinationEn->translationEn->text }}</td>
                            <td>
                                <a href="{{ '/events/' . $item->id . '/edit' }}" class="btn btn-primary" style="color: #ffa000;">Edit</a>
                                <br>
                                <form action="{{ '/events/' . $item->id }}"
                                      method="POST"
                                      style="display:inline-block; margin-top: 0.1em;"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger"
                                            style="color: #e53935;"
                                            onclick="return confirm('Are you sure you want to delete this record?')"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</x-layout>

<script>
    let events = @json($records);
    let range = @json($range);

    function updateStatuses() {
        let now_ = new Date(),
            now = now_.getTime(),
            left_range_start = new Date(now + (range * 60000)).getTime(),
            right_range_start = new Date(now + ((range + 5) * 60000)).getTime(),
            range_end = new Date(now - (range * 60000)).getTime();

        let new_status_id = 0;

        events.forEach(function(event) {
            let time_start_ = new Date(event.time_start),
                time_end_ = new Date(event.time_end);

            let time_start_full = `${time_start_.getHours().toString().padStart(2, '0')}:${time_start_.getMinutes().toString().padStart(2, '0')}`,
                time_end_full = `${time_start_.getHours().toString().padStart(2, '0')}:${time_start_.getMinutes().toString().padStart(2, '0')}`;

            let time_start = time_start_.getTime(),
                time_end = time_end_.getTime();

            switch (event) {
                // Waiting -> Boarding
                case 2:
                    if (left_range_start <= time_start <= right_range_start) {
                        new_status_id = 3;
                    }
                    break;

                    // Boarding -> Departed
                case 3:
                    if (time_start <= now) {
                        new_status_id = 4;
                    }
                    break;

                    // Departed -> Returning
                case 4:
                    if (time_end <= now <= range_end) {
                        new_status_id = 5;
                    }
                    break;

                    // Returning -> Returned
                case 5:
                    if (time_end <= now) {
                        new_status_id = 6;
                    }
                    break;
            }

            if (new_status_id !== 0) {
                updateEvent(event.id, new_status_id);
            }
        });
    }

    function updateEvent(event_id, status_id) {
        let json = JSON.stringify({status_id: status_id});
        let xhr = new XMLHttpRequest();

        xhr.open('PUT', `/events/${event_id}`, true);
        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

        // xhr.onload
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(`event ${event_id}, new status ${status_id}`);
            }
        };

        xhr.send(json);
    }

    // updateStatuses();
    // setInterval(updateStatuses, 10000);
</script>
