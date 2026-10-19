@php
    
    $all = \App\Models\Teacher::orderBy('name')->get();

    $departments = $all->pluck('department')->unique()->sort()->values();

    // ---------------------------------------------------------------
    // Read input from the URL: ?q=...&dept=...&id=...
    // ---------------------------------------------------------------
    $search = trim((string) request()->query('q', ''));
    $dept   = (string) request()->query('dept', '');
    if (! $departments->contains($dept)) {
        $dept = '';
    }

    $detail = request()->filled('id')
        ? $all->firstWhere('id', (int) request()->query('id'))
        : null;

    // ---------------------------------------------------------------
    // Filter the list
    // ---------------------------------------------------------------
    $teachers = $all->filter(function ($t) use ($search, $dept) {
        if ($dept !== '' && $t['department'] !== $dept) {
            return false;
        }
        if ($search !== '') {
            $haystack = mb_strtolower($t['name'] . ' ' . $t['subject']);
            if (! str_contains($haystack, mb_strtolower($search))) {
                return false;
            }
        }
        return true;
    })->values();

    $baseUrl = route('teachers.index', absolute: false);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Teachers</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-green-100 font-sans text-slate-900">
<header class="bg-green-800 px-4 py-8 text-center text-white">
    <h1 class="text-3xl font-bold">Our Teachers</h1>
    <p class="mt-1 text-green-50">Meet the staff who make our school great</p>
    <p class="mt-3"><a class="font-medium text-white underline hover:text-green-100" href="{{ route('people.index') }}">People directory</a></p>
</header>

<main class="mx-auto max-w-5xl px-4 py-8 sm:px-6">
@if ($detail)

    <p class="mb-6">
        <a class="inline-block rounded-lg border border-green-800 bg-white px-4 py-2 font-semibold text-green-900 no-underline hover:bg-green-50"
           href="{{ $baseUrl }}">&larr; Back to all teachers</a>
    </p>

    <section class="rounded-xl border border-green-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-green-800 text-2xl font-bold text-white">{{ $detail['initials'] }}</div>
        <h2 class="text-2xl font-bold">{{ $detail['name'] }}</h2>
        <span class="mt-2 inline-block w-fit rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-900">{{ $detail['department'] }}</span>

        <dl class="mt-6 grid grid-cols-1 gap-x-6 gap-y-3 sm:grid-cols-[max-content_1fr]">
            <dt class="font-semibold text-slate-600">Subject</dt>        <dd>{{ $detail['subject'] }}</dd>
            <dt class="font-semibold text-slate-600">Qualification</dt>  <dd>{{ $detail['qualification'] }}</dd>
            <dt class="font-semibold text-slate-600">Experience</dt>     <dd>{{ $detail['years'] }} years</dd>
            <dt class="font-semibold text-slate-600">Room</dt>           <dd>{{ $detail['room'] }}</dd>
            <dt class="font-semibold text-slate-600">Email</dt>
            <dd><a class="text-green-800 underline hover:text-green-950" href="mailto:{{ $detail['email'] }}">{{ $detail['email'] }}</a></dd>
        </dl>

        <p class="mt-6 leading-relaxed text-slate-700">{{ $detail['bio'] }}</p>
    </section>

@else

    <form class="mb-6 flex flex-wrap items-center gap-3" method="get" action="{{ $baseUrl }}">
        <input class="min-w-56 flex-1 rounded-lg border border-green-300 bg-white px-3 py-2 text-slate-900 placeholder:text-slate-500 focus:border-green-700 focus:outline-none focus:ring-2 focus:ring-green-200"
               type="search" name="q" placeholder="Search by name or subject…" value="{{ $search }}">
        <select class="rounded-lg border border-green-300 bg-white px-3 py-2 text-slate-900 focus:border-green-700 focus:outline-none focus:ring-2 focus:ring-green-200"
                name="dept">
            <option value="">All departments</option>
            @foreach ($departments as $d)
                <option value="{{ $d }}" @selected($d === $dept)>{{ $d }}</option>
            @endforeach
        </select>
        <button class="cursor-pointer rounded-lg bg-green-800 px-4 py-2 font-semibold text-white hover:bg-green-900"
                type="submit">Filter</button>
        @if ($search !== '' || $dept !== '')
            <a class="rounded-lg border border-green-800 bg-white px-4 py-2 font-semibold text-green-900 no-underline hover:bg-green-50"
               href="{{ $baseUrl }}">Clear</a>
        @endif
    </form>

    <p class="mb-4 text-sm text-slate-600">Showing {{ $teachers->count() }} of {{ $all->count() }} teachers</p>

    @if ($teachers->isEmpty())
        <div class="rounded-xl border border-green-200 bg-white px-4 py-12 text-center text-slate-600">No teachers match your search.</div>
    @else
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($teachers as $t)
                <article class="flex flex-col gap-2 rounded-xl border border-green-200 bg-white p-5 shadow-sm">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-800 text-lg font-bold text-white">{{ $t['initials'] }}</div>
                    <h2 class="mt-1 text-lg font-semibold">{{ $t['name'] }}</h2>
                    <span class="inline-block w-fit rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-900">{{ $t['department'] }}</span>
                    <div><strong>{{ $t['subject'] }}</strong></div>
                    <div class="text-sm text-slate-600">Room {{ $t['room'] }} &middot; {{ $t['years'] }} yrs experience</div>
                    <a class="mt-auto pt-2 font-semibold text-green-800 no-underline hover:text-green-950"
                       href="{{ $baseUrl }}?id={{ $t['id'] }}">View profile &rarr;</a>
                </article>
            @endforeach
        </div>
    @endif

@endif
</main>
</body>
</html>