<?php

namespace Tests\Feature;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeachersTest extends TestCase
{
    use RefreshDatabase;

    public function test_teacher_pages_are_available(): void
    {
        $teacher = Teacher::create($this->teacherData());

        $this->get(route('teachers.index'))->assertOk();
        $this->get(route('teachers.create'))->assertOk();
        $this->get(route('teachers.edit', $teacher))->assertOk();
    }

    public function test_welcome_and_teachers_pages_use_the_shared_layout(): void
    {
        $this->get(route('welcome'))
            ->assertOk()
            ->assertSee('Our School')
            ->assertSee('bg-orange-100');

        $this->get(route('teachers.index'))
            ->assertOk()
            ->assertSee('Our School')
            ->assertSee('bg-orange-100');
    }

    public function test_a_teacher_can_be_added(): void
    {
        $teacherData = $this->teacherData();
        $response = $this->post(route('teachers.store'), $teacherData);

        $teacher = Teacher::query()->firstOrFail();

        $response->assertRedirect(route('teachers.index', ['id' => $teacher->id]));
        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'name' => $teacherData['name'],
            'email' => $teacherData['email'],
        ]);
    }

    public function test_teacher_fields_are_required(): void
    {
        $this->from(route('teachers.create'))
            ->post(route('teachers.store'), [])
            ->assertRedirect(route('teachers.create'))
            ->assertSessionHasErrors([
                'name', 'email', 'subject', 'department', 'room',
                'years', 'qualification', 'bio',
            ]);

        $this->assertDatabaseCount('teachers', 0);
    }

    public function test_a_teacher_can_be_updated(): void
    {
        $teacher = Teacher::create($this->teacherData());

        $this->put(route('teachers.update', $teacher), [
            ...$this->teacherData(),
            'name' => 'Alex Rivera',
        ])->assertRedirect(route('teachers.index', ['id' => $teacher->id]));

        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'name' => 'Alex Rivera',
        ]);
    }

    private function teacherData(): array
    {
        return [
            'name' => 'Morgan Lee',
            'subject' => 'Science',
            'department' => 'STEM',
            'email' => 'morgan.lee@example.com',
            'room' => '204',
            'years' => 8,
            'qualification' => 'MSc',
            'bio' => 'Science teacher.',
        ];
    }
}
