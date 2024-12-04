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

            <div class="mt-6">
                {{ $records->links() }}
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
        console.log(`now: ${now_.getHours().toString().padStart(2, '0')}:${now_.getMinutes().toString().padStart(2, '0')}`);
        console.log(`now: ${now}`);
        console.log(`left_range_start: ${left_range_start}`);
        console.log(`right_range_start: ${right_range_start}`);
        console.log(`range_end: ${range_end}`);

        let new_status_id = 0;

        events.forEach(function(event) {
            let time_start_ = new Date(event.time_start),
                time_end_ = new Date(event.time_end);

            let time_start_full = `${time_start_.getHours().toString().padStart(2, '0')}:${time_start_.getMinutes().toString().padStart(2, '0')}`,
                time_end_full = `${time_start_.getHours().toString().padStart(2, '0')}:${time_start_.getMinutes().toString().padStart(2, '0')}`;

            let time_start = time_start_.getTime(),
                time_end = time_end_.getTime();

            console.log(`${event.id}: ${event.status_en.translation_en.text} | ${time_start_full} - ${time_end_full}`);

            switch (event) {
                // Waiting -> Boarding
                case 2:
                    if (left_range_start <= time_start <= right_range_start) {
                        new_status_id = 3;
                        console.log(`   to Boarding`);
                    }
                    break;

                // Boarding -> Departed
                case 3:
                    if (time_start <= now) {
                        new_status_id = 4;
                        console.log(`   to Departed`);
                    }
                    break;

                // Departed -> Returning
                case 4:
                    if (time_end <= now <= range_end) {
                        new_status_id = 5;
                        console.log(`   to Returning`);
                    }
                    break;

                // Returning -> Returned
                case 5:
                    if (time_end <= now) {
                        new_status_id = 6;
                        console.log(`   to Returned`);
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
        xhr.setRequestHeader('Content-type','application/json; charset=utf-8');

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
