<x-app-layout>
    <div class="w-[400px] mx-auto bg-emerald-500 py-2 px-3 text-white rounded">
        {{$user->name}}, Your order has been completed!!
    </div>
    <br>
    <div class="flex justify-center"> <!-- Center horizontally -->
        <form method="GET" action="/">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Go Back to Store</button>
        </form>
    </div>
</x-app-layout>
