<x-background-layout title="People">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">People</h1>
            <p class="mt-1 text-slate-600">Browse the people saved in the directory.</p>
        </div>
        <a class="rounded bg-green-700 px-4 py-2 font-semibold text-white hover:bg-green-800"
           href="{{ route('people.create') }}">Add a person</a>
    </div>

    @if (session('status'))
        <p class="mt-6 rounded border border-green-300 bg-green-50 p-3 text-green-900">{{ session('status') }}</p>
    @endif

    <div class="mt-6 space-y-3">
        @forelse ($people as $person)
            <a class="block rounded-lg border border-green-200 bg-white p-4 shadow-sm hover:border-green-500"
               href="{{ route('people.show', $person) }}">
                <span class="block text-lg font-semibold">{{ $person->name }}</span>
                <span class="text-slate-600">{{ $person->role }}</span>
            </a>
        @empty
            <p class="rounded-lg border border-green-200 bg-white p-4 text-slate-600">No people have been added yet.</p>
        @endforelse
    </div>
</x-background-layout>
