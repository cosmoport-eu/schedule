<x-dictionaries-main>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between items-center mx-auto">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Types</h1>

            <a href="/types/create"
               type="button"
               class="py-2.5 px-5 ml-16 mb-2 mt-2 text-xl font-medium text-gray-900 focus:outline-none
                bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700
                focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800
                dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700
                uppercase font-semibold"
            >add</a>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
                <table class="w-full text-lg text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="font-bold">
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Subtypes number</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $item)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->categoryEn->translationEn->text }}</td>
                            <td class="px-6 py-4">{{ $item->nameTranslationEn->text }}</td>
                            <td class="px-6 py-4">{{ $item->descrTranslationEn->text }}</td>
                            <td class="px-6 py-4">{{ $item->subtypesEn->count() }}</td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}
                            </th>
                            <td>
                                <a href="{{ '/types/' . $item->id . '/edit' }}" class="btn btn-primary" style="color: #ffa000;">Edit</a>
                                <br>
                                <form action="{{ '/types/' . $item->id }}"
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
</x-dictionaries-main>
