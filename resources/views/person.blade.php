<x-background-layout title="{{ $person->name }}">
    <a class="font-medium text-green-800 underline" href="{{ route('people.index') }}">All people</a>

    @if (session('status'))
        <p class="mt-6 rounded border border-green-300 bg-green-50 p-3 text-green-900">{{ session('status') }}</p>
    @endif

    <section class="mt-6 rounded-xl border border-green-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-wide text-green-800">Person #{{ $person->id }}</p>
        <h1 class="mt-2 text-3xl font-bold">{{ $person->name }}</h1>
        <p class="mt-2 text-lg text-slate-600">{{ $person->role }}</p>
    </section>

    <a class="mt-6 inline-block rounded bg-green-700 px-4 py-2 font-semibold text-white hover:bg-green-800"
       href="{{ route('people.create') }}">Add another person</a>
</x-background-layout>