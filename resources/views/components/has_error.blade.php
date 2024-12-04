@if (session()->has('error'))
    <div class="m-4">
        <p class="text-red-500 text-xl">{{ session('error') }}</p>
    </div>
@endif
