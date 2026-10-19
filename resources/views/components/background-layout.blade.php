@props(['title' => config('app.name', 'Laravel')])

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-green-100 font-sans text-slate-900">
    <main class="mx-auto w-full max-w-4xl p-6">
        {{ $slot }}
    </main>
</body>
</html>