<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Our School</title>
    @vite('resources/css/app.css')
    <style>
        :root {
            --bg: #f5f6fa;
            --card: #ffffff;
            --text: #1f2430;
            --muted: #6b7280;
            --accent: #2f5bea;
            --accent-dark: #2447bd;
            --border: #e2e5ee;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            color: var(--text);
            line-height: 1.6;
        }
        a { color: var(--accent); }

        nav {
            background: var(--card);
            border-bottom: 1px solid var(--border);
        }
        nav .inner {
            max-width: 1000px; margin: 0 auto; padding: 1rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        nav .brand { font-weight: 700; font-size: 1.15rem; text-decoration: none; color: var(--text); }
        nav .links a { margin-left: 1.25rem; text-decoration: none; font-weight: 500; }

        .hero {
            background: var(--accent);
            color: #fff;
            text-align: center;
            padding: 4.5rem 1rem;
        }
        .hero h1 { margin: 0 0 .75rem; font-size: clamp(2rem, 5vw, 3rem); }
        .hero p  { margin: 0 auto 2rem; max-width: 560px; opacity: .9; font-size: 1.1rem; }
        .btn {
            display: inline-block;
            padding: .8rem 1.6rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
        }
        .btn.primary { background: #fff; color: var(--accent); }
        .btn.primary:hover { background: #eaf0ff; }

        main { max-width: 1000px; margin: 0 auto; padding: 3rem 1rem; }
        main h2 { text-align: center; margin: 0 0 2rem; }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
        }
        .card h3 { margin: 0 0 .5rem; }
        .card p  { margin: 0 0 1rem; color: var(--muted); }
        .card a  { font-weight: 600; text-decoration: none; }

        footer {
            text-align: center;
            color: var(--muted);
            font-size: .9rem;
            padding: 2rem 1rem 3rem;
        }
    </style>
</head>
<body class="bg-green-100">

{{--
    Links use named routes. The names must exist in routes/web.php:
        ->name('welcome')         on the route that serves this page
        ->name('teachers.index')  on the /teachers route
    absolute: false makes route() return a relative path such as /teachers,
    which stays on whatever host the browser is already using.
--}}

<nav>
    <div class="inner">
        <a class="brand" href="{{ route('welcome', absolute: false) }}">Our School</a>
        <div class="links">
            <a href="{{ route('welcome', absolute: false) }}">Home</a>
            <a href="{{ route('teachers.index', absolute: false) }}">Teachers</a>
            <a href="{{ route('people.index', absolute: false) }}">People</a>
        </div>
    </div>
</nav>

<section class="hero">
    <h1>Welcome to Our School</h1>
    <p>A place where students and teachers learn, grow and achieve together.</p>
    <a class="btn primary" href="{{ route('teachers.index', absolute: false) }}">Meet our teachers</a>
</section>

<main>
    <h2>What you'll find here</h2>
    <div class="grid">
        <div class="card">
            <h3>Our Teachers</h3>
            <p>Browse our staff, search by name or subject, and read about their experience.</p>
            <a href="{{ route('teachers.index') }}">View teachers &rarr;</a>
        </div>
        <div class="card">
            <h3>Departments</h3>
            <p>From STEM to Humanities and Sport &amp; Arts, filter staff by department.</p>
            <a href="{{ route('teachers.index', absolute: false) }}">Browse departments &rarr;</a>
        </div>
        <div class="card">
            <h3>Get in touch</h3>
            <p>Each teacher's profile includes their room and contact email.</p>
            <a href="{{ route('teachers.index', absolute: false) }}">Find a teacher &rarr;</a>
        </div>
    </div>
</main>

<footer>
    &copy; {{ date('Y') }} Our School. All rights reserved.
</footer>

</body>
</html>