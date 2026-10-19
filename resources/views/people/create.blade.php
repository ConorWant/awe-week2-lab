<x-background-layout title="Add a person">
    <a class="font-medium text-green-800 underline" href="{{ route('people.index') }}">Back to people</a>

    <h1 class="mt-6 text-3xl font-bold">Add a person</h1>
    <p class="mt-1 text-slate-600">Enter a name and role to add them to the directory.</p>

    <form class="mt-6 space-y-5 rounded-xl border border-green-200 bg-white p-6 shadow-sm"
          method="POST" action="{{ route('people.store') }}">
        @csrf

        <div>
            <label class="mb-1 block font-semibold" for="name">Name</label>
            <input class="w-full rounded border border-slate-300 px-3 py-2 focus:border-green-700 focus:outline-none"
                   id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255">
            @error('name')
                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-1 block font-semibold" for="role">Role</label>
            <input class="w-full rounded border border-slate-300 px-3 py-2 focus:border-green-700 focus:outline-none"
                   id="role" name="role" type="text" value="{{ old('role') }}" required maxlength="255">
            @error('role')
                <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
            @enderror
        </div>

        <button class="rounded bg-green-700 px-4 py-2 font-semibold text-white hover:bg-green-800"
                type="submit">Save person</button>
    </form>
</x-background-layout>
