<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonController extends Controller
{
    public function index(): View
    {
        return view('people.index', [
            'people' => Person::query()->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('people.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
        ]);

        $person = Person::create($validated);

        return to_route('people.show', $person)
            ->with('status', 'Person added successfully.');
    }

    public function show(Person $person): View
    {
        return view('person', ['person' => $person]);
    }
}
