<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Sarah Whitfield', 'subject' => 'Mathematics',
                'department' => 'STEM', 'email' => 's.whitfield@example-school.org',
                'room' => 'M12', 'years' => 12, 'qualification' => 'MSc Mathematics, PGCE',
                'bio' => 'Head of Mathematics. Runs the after-school maths club and coaches the UKMT team.',
            ],
            [
                'name' => 'David Okafor', 'subject' => 'Physics',
                'department' => 'STEM', 'email' => 'd.okafor@example-school.org',
                'room' => 'S3', 'years' => 8, 'qualification' => 'BSc Physics, PGCE',
                'bio' => 'Enjoys practical demonstrations and leads the school astronomy society.',
            ],
            [
                'name' => 'Emily Hartley', 'subject' => 'English Literature',
                'department' => 'Humanities', 'email' => 'e.hartley@example-school.org',
                'room' => 'E4', 'years' => 15, 'qualification' => 'MA English Literature, PGCE',
                'bio' => 'Head of English. Organises the annual creative writing competition.',
            ],
            [
                'name' => 'Marcus Reid', 'subject' => 'History',
                'department' => 'Humanities', 'email' => 'm.reid@example-school.org',
                'room' => 'H2', 'years' => 5, 'qualification' => 'BA History, PGCE',
                'bio' => 'Specialises in 20th century history and runs the Year 9 museum trip.',
            ],
            [
                'name' => 'Priya Nair', 'subject' => 'Computer Science',
                'department' => 'STEM', 'email' => 'p.nair@example-school.org',
                'room' => 'IT1', 'years' => 6, 'qualification' => 'BSc Computer Science, PGCE',
                'bio' => 'Teaches GCSE and A-level Computer Science and runs the coding club.',
            ],
            [
                'name' => 'Tom Gallagher', 'subject' => 'Physical Education',
                'department' => 'Sport & Arts', 'email' => 't.gallagher@example-school.org',
                'room' => 'Sports Hall', 'years' => 10, 'qualification' => 'BSc Sport Science, PGCE',
                'bio' => 'Head of PE. Coaches the school football and cross-country teams.',
            ],
            [
                'name' => 'Isabelle Moreau', 'subject' => 'French & Art',
                'department' => 'Sport & Arts', 'email' => 'i.moreau@example-school.org',
                'room' => 'A1', 'years' => 7, 'qualification' => 'BA Modern Languages, PGCE',
                'bio' => 'Teaches French and runs the Art Club. Organises the annual Paris exchange.',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}