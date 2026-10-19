<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        return view('teachers', [
            'teachers' => Teacher::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('teacher.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $teacher = Teacher::create($this->validatedTeacherData($request));

        return to_route('teachers.index', ['id' => $teacher->id])
            ->with('status', 'Teacher added successfully.');
    }

    public function edit(Teacher $teacher): View
    {
        return view('teacher.edit', ['teacher' => $teacher]);
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $teacher->update($this->validatedTeacherData($request, $teacher));

        return to_route('teachers.index', ['id' => $teacher->id])
            ->with('status', 'Teacher updated successfully.');
    }

    private function validatedTeacherData(Request $request, ?Teacher $teacher = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('teachers', 'email')->ignore($teacher?->id),
            ],
            'subject' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'room' => ['required', 'string', 'max:255'],
            'years' => ['required', 'integer', 'min:0', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string'],
        ]);
    }
}
