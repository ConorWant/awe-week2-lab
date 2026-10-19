@props(['title' => config('app.name', 'Laravel')])

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-orange-100 font-sans text-slate-900">
    <nav class="border-b border-orange-200 bg-white">
        <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a class="text-lg font-bold text-slate-800 no-underline" href="{{ route('welcome') }}">Our School</a>
            <div class="flex flex-wrap gap-5 font-medium">
                <a class="text-orange-900 no-underline hover:text-orange-950" href="{{ route('welcome') }}">Home</a>
                <a class="text-orange-900 no-underline hover:text-orange-950" href="{{ route('teachers.index') }}">Teachers</a>
                <a class="text-orange-900 no-underline hover:text-orange-950" href="{{ route('people.index') }}">People</a>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <footer class="px-4 pb-8 pt-6 text-center text-sm text-slate-600">
        &copy; {{ date('Y') }} Our School. All rights reserved.
    </footer>
</body>
</html>