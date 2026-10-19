<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Our School</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-green-100 font-sans leading-relaxed text-slate-800">

{{--
    Links use named routes. The names must exist in routes/web.php:
        ->name('welcome')         on the route that serves this page
        ->name('teachers.index')  on the /teachers route
    absolute: false makes route() return a relative path such as /teachers,
    which stays on whatever host the browser is already using.
--}}

<nav>
    <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-4 border-b border-green-200 bg-white px-4 py-4 sm:px-6">
        <a class="text-lg font-bold text-slate-800 no-underline" href="{{ route('welcome', absolute: false) }}">Our School</a>
        <div class="flex flex-wrap gap-5 font-medium">
            <a class="text-green-800 no-underline hover:text-green-950" href="{{ route('welcome', absolute: false) }}">Home</a>
            <a class="text-green-800 no-underline hover:text-green-950" href="{{ route('teachers.index', absolute: false) }}">Teachers</a>
            <a class="text-green-800 no-underline hover:text-green-950" href="{{ route('people.index', absolute: false) }}">People</a>
        </div>
    </div>
</nav>

<section class="bg-green-800 px-4 py-16 text-center text-white sm:py-20">
    <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Welcome to Our School</h1>
    <p class="mx-auto mb-8 mt-4 max-w-xl text-lg text-green-50">A place where students and teachers learn, grow and achieve together.</p>
    <a class="inline-block rounded-lg bg-white px-6 py-3 font-semibold text-green-900 no-underline hover:bg-green-50"
       href="{{ route('teachers.index', absolute: false) }}">Meet our teachers</a>
</section>

<main class="mx-auto max-w-5xl px-4 py-12 sm:px-6">
    <h2 class="mb-8 text-center text-2xl font-bold text-slate-900">What you'll find here</h2>
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-xl border border-green-200 bg-white p-6 shadow-sm">
            <h3 class="mb-2 text-xl font-semibold">Our Teachers</h3>
            <p class="mb-4 text-slate-600">Browse our staff, search by name or subject, and read about their experience.</p>
            <a class="font-semibold text-green-800 no-underline hover:text-green-950" href="{{ route('teachers.index') }}">View teachers &rarr;</a>
        </div>
        <div class="rounded-xl border border-green-200 bg-white p-6 shadow-sm">
            <h3 class="mb-2 text-xl font-semibold">Departments</h3>
            <p class="mb-4 text-slate-600">From STEM to Humanities and Sport &amp; Arts, filter staff by department.</p>
            <a class="font-semibold text-green-800 no-underline hover:text-green-950" href="{{ route('teachers.index', absolute: false) }}">Browse departments &rarr;</a>
        </div>
        <div class="rounded-xl border border-green-200 bg-white p-6 shadow-sm">
            <h3 class="mb-2 text-xl font-semibold">Get in touch</h3>
            <p class="mb-4 text-slate-600">Each teacher's profile includes their room and contact email.</p>
            <a class="font-semibold text-green-800 no-underline hover:text-green-950" href="{{ route('teachers.index', absolute: false) }}">Find a teacher &rarr;</a>
        </div>
    </div>
</main>

<footer class="px-4 pb-10 pt-6 text-center text-sm text-slate-600">
    &copy; {{ date('Y') }} Our School. All rights reserved.
</footer>

</body>
</html>