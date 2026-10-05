@php
    // ---------------------------------------------------------------
    // Data (hard-coded sample teachers). No controller needed.
    // ---------------------------------------------------------------
    $all = collect([
        [
            'id' => 1, 'name' => 'Sarah Whitfield', 'subject' => 'Mathematics',
            'department' => 'STEM', 'email' => 's.whitfield@example-school.org',
            'room' => 'M12', 'years' => 12, 'qualification' => 'MSc Mathematics, PGCE',
            'bio' => 'Head of Mathematics. Runs the after-school maths club and coaches the UKMT team.',
        ],
        [
            'id' => 2, 'name' => 'David Okafor', 'subject' => 'Physics',
            'department' => 'STEM', 'email' => 'd.okafor@example-school.org',
            'room' => 'S3', 'years' => 8, 'qualification' => 'BSc Physics, PGCE',
            'bio' => 'Enjoys practical demonstrations and leads the school astronomy society.',
        ],
        [
            'id' => 3, 'name' => 'Emily Hartley', 'subject' => 'English Literature',
            'department' => 'Humanities', 'email' => 'e.hartley@example-school.org',
            'room' => 'E4', 'years' => 15, 'qualification' => 'MA English Literature, PGCE',
            'bio' => 'Head of English. Organises the annual creative writing competition.',
        ],
        [
            'id' => 4, 'name' => 'Marcus Reid', 'subject' => 'History',
            'department' => 'Humanities', 'email' => 'm.reid@example-school.org',
            'room' => 'H2', 'years' => 5, 'qualification' => 'BA History, PGCE',
            'bio' => 'Specialises in 20th century history and runs the Year 9 museum trip.',
        ],
        [
            'id' => 5, 'name' => 'Priya Nair', 'subject' => 'Computer Science',
            'department' => 'STEM', 'email' => 'p.nair@example-school.org',
            'room' => 'IT1', 'years' => 6, 'qualification' => 'BSc Computer Science, PGCE',
            'bio' => 'Teaches GCSE and A-level Computer Science and runs the coding club.',
        ],
        [
            'id' => 6, 'name' => 'Tom Gallagher', 'subject' => 'Physical Education',
            'department' => 'Sport & Arts', 'email' => 't.gallagher@example-school.org',
            'room' => 'Sports Hall', 'years' => 10, 'qualification' => 'BSc Sport Science, PGCE',
            'bio' => 'Head of PE. Coaches the school football and cross-country teams.',
        ],
        [
            'id' => 7, 'name' => 'Isabelle Moreau', 'subject' => 'French & Art',
            'department' => 'Sport & Arts', 'email' => 'i.moreau@example-school.org',
            'room' => 'A1', 'years' => 7, 'qualification' => 'BA Modern Languages, PGCE',
            'bio' => 'Teaches French and runs the Art Club. Organises the annual Paris exchange.',
        ],
    ])->map(function ($t) {
        // Initials for the avatar circle, e.g. "Sarah Whitfield" -> "SW"
        $parts = preg_split('/\s+/', trim($t['name']));
        $t['initials'] = mb_strtoupper(mb_substr($parts[0], 0, 1) . mb_substr(end($parts), 0, 1));
        return $t;
    });

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

    $baseUrl = url('/teachers');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Teachers</title>
    <style>
        :root {
            --bg: #f5f6fa;
            --card: #ffffff;
            --text: #1f2430;
            --muted: #6b7280;
            --accent: #2f5bea;
            --border: #e2e5ee;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }
        header {
            background: var(--accent);
            color: #fff;
            padding: 2rem 1rem;
            text-align: center;
        }
        header h1 { margin: 0 0 .25rem; }
        header p  { margin: 0; opacity: .85; }
        main { max-width: 1000px; margin: 0 auto; padding: 1.5rem 1rem 3rem; }

        form.filters {
            display: flex; flex-wrap: wrap; gap: .75rem;
            margin-bottom: 1.5rem;
        }
        form.filters input, form.filters select, form.filters button, .btn {
            padding: .6rem .8rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font: inherit;
            background: #fff;
        }
        form.filters input { flex: 1 1 220px; }
        form.filters button, .btn {
            background: var(--accent); color: #fff; border-color: var(--accent);
            cursor: pointer; text-decoration: none; display: inline-block;
        }
        .btn.secondary { background: #fff; color: var(--accent); }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
            display: flex; flex-direction: column; gap: .5rem;
        }
        .avatar {
            width: 56px; height: 56px; border-radius: 50%;
            background: var(--accent); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1.1rem;
        }
        .card h2 { margin: .25rem 0 0; font-size: 1.15rem; }
        .tag {
            display: inline-block; font-size: .75rem;
            background: #eaf0ff; color: var(--accent);
            padding: .15rem .6rem; border-radius: 999px; width: fit-content;
        }
        .muted { color: var(--muted); font-size: .9rem; }
        .card a.more { margin-top: auto; color: var(--accent); font-weight: 600; text-decoration: none; }

        .detail {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 12px; padding: 2rem;
        }
        .detail .avatar { width: 80px; height: 80px; font-size: 1.6rem; margin-bottom: 1rem; }
        .detail dl { display: grid; grid-template-columns: max-content 1fr; gap: .5rem 1.5rem; margin: 1.5rem 0; }
        .detail dt { font-weight: 600; color: var(--muted); }
        .detail dd { margin: 0; }
        .empty { text-align: center; color: var(--muted); padding: 3rem 0; }
    </style>
</head>
<body>
<header>
    <h1>Our Teachers</h1>
    <p>Meet the staff who make our school great</p>
</header>

<main>
@if ($detail)

    <p><a class="btn secondary" href="{{ $baseUrl }}">&larr; Back to all teachers</a></p>

    <section class="detail">
        <div class="avatar">{{ $detail['initials'] }}</div>
        <h2>{{ $detail['name'] }}</h2>
        <span class="tag">{{ $detail['department'] }}</span>

        <dl>
            <dt>Subject</dt>        <dd>{{ $detail['subject'] }}</dd>
            <dt>Qualification</dt>  <dd>{{ $detail['qualification'] }}</dd>
            <dt>Experience</dt>     <dd>{{ $detail['years'] }} years</dd>
            <dt>Room</dt>           <dd>{{ $detail['room'] }}</dd>
            <dt>Email</dt>
            <dd><a href="mailto:{{ $detail['email'] }}">{{ $detail['email'] }}</a></dd>
        </dl>

        <p>{{ $detail['bio'] }}</p>
    </section>

@else

    <form class="filters" method="get" action="{{ $baseUrl }}">
        <input type="search" name="q" placeholder="Search by name or subject…" value="{{ $search }}">
        <select name="dept">
            <option value="">All departments</option>
            @foreach ($departments as $d)
                <option value="{{ $d }}" @selected($d === $dept)>{{ $d }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
        @if ($search !== '' || $dept !== '')
            <a class="btn secondary" href="{{ $baseUrl }}">Clear</a>
        @endif
    </form>

    <p class="muted">Showing {{ $teachers->count() }} of {{ $all->count() }} teachers</p>

    @if ($teachers->isEmpty())
        <div class="empty">No teachers match your search.</div>
    @else
        <div class="grid">
            @foreach ($teachers as $t)
                <article class="card">
                    <div class="avatar">{{ $t['initials'] }}</div>
                    <h2>{{ $t['name'] }}</h2>
                    <span class="tag">{{ $t['department'] }}</span>
                    <div><strong>{{ $t['subject'] }}</strong></div>
                    <div class="muted">Room {{ $t['room'] }} &middot; {{ $t['years'] }} yrs experience</div>
                    <a class="more" href="{{ $baseUrl }}?id={{ $t['id'] }}">View profile &rarr;</a>
                </article>
            @endforeach
        </div>
    @endif

@endif
</main>
</body>
</html>