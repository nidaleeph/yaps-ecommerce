<!-- resources/views/errors/404.blade.php -->

<x-app-layout>

    <div class="container mx-auto flex flex-col items-center pt-20 min-h-screen">
        <img class="max-w-full h-auto mb-4" src="{{ asset('img/404.png') }}" alt="404 Image">
        {{-- <h1 class="text-4xl font-bold mb-2">404 - Not Found</h1> --}}
        <p class="text-2xl mb-8 text-red-500">The page you are looking for might not exist or has been removed.</p>
    </div>

</x-app-layout>
