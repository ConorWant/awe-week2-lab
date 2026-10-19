<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;

    public function test_people_pages_are_available(): void
    {
        $this->get(route('people.index'))->assertOk();
        $this->get(route('people.create'))->assertOk();
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

    public function test_a_person_can_be_added_and_viewed(): void
    {
        $response = $this->post(route('people.store'), [
            'name' => 'Alex Rivera',
            'role' => 'Teacher',
        ]);

        $person = Person::query()->firstOrFail();

        $response->assertRedirect(route('people.show', $person));
        $this->assertDatabaseHas('people', [
            'id' => $person->id,
            'name' => 'Alex Rivera',
            'role' => 'Teacher',
        ]);

        $this->get(route('people.show', $person))
            ->assertOk()
            ->assertSee('Alex Rivera')
            ->assertSee('Teacher');
    }

    public function test_person_fields_are_required(): void
    {
        $this->from(route('people.create'))
            ->post(route('people.store'), [])
            ->assertRedirect(route('people.create'))
            ->assertSessionHasErrors(['name', 'role']);

        $this->assertDatabaseCount('people', 0);
    }
}
