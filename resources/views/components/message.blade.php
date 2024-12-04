@if (session()->has('success'))
    <div x-data="{ show:true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="fixed bg-green-600 text-white py-4 px-4 rounded-xl right-3"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif
