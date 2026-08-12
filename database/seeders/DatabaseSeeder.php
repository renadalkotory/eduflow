<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Credential;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\QuizQuestion;
use App\Models\Section;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $instructor = User::query()->updateOrCreate(
            ['email' => 'elena@eduflow.test'],
            [
                'name' => 'Dr. Elena Rostova',
                'password' => Hash::make('password'),
                'professional_title' => 'Senior Lecturer in Cognitive Science',
                'biography' => 'Dr. Elena Rostova is a leading researcher in the intersection of cognitive psychology and human-computer interaction. With over 15 years of academic experience, she has published numerous papers on attention, memory, and digital learning environments. She currently leads the HCI lab at Modernist University.',
                'website_url' => 'elenarostova.academic.edu',
                'profile_picture' => null,
                'is_verified' => true,
                'total_students' => 12480,
            ]
        );

        Credential::query()->where('user_id', $instructor->id)->delete();

        Credential::insert([
            [
                'user_id' => $instructor->id,
                'title' => 'Ph.D. in Cognitive Science',
                'institution' => 'University of Modern Studies',
                'icon' => 'mortarboard',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $instructor->id,
                'title' => 'Certified UX Professional',
                'institution' => 'Interaction Design Foundation',
                'icon' => 'award',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $categories = collect([
            'Web Development',
            'UI/UX Design',
            'Programming',
            'Database',
            'Business',
            'Machine Learning',
        ])->map(fn (string $name) => Category::query()->firstOrCreate(['name' => $name]));

        $course = Course::query()->updateOrCreate(
            [
                'user_id' => $instructor->id,
                'title' => 'Advanced Machine Learning',
            ],
            [
                'category_id' => $categories->firstWhere('name', 'Machine Learning')?->id,
                'short_description' => 'Deep dive into neural networks and modern ML techniques.',
                'detailed_description' => 'A comprehensive course covering neural networks, activation functions, and practical ML workflows.',
                'price' => 79.99,
                'promo_video_url' => 'https://vimeo.com/example',
                'status' => 'draft',
            ]
        );

        Section::query()->where('course_id', $course->id)->delete();

        $sectionOne = Section::create([
            'course_id' => $course->id,
            'title' => 'Section 1: Introduction to Neural Networks',
            'status' => 'published',
            'duration_seconds' => 2700,
            'sort_order' => 1,
        ]);

        Section::create([
            'course_id' => $course->id,
            'title' => 'Section 2: Activation Functions',
            'status' => 'draft',
            'duration_seconds' => 0,
            'sort_order' => 2,
        ]);

        Section::create([
            'course_id' => $course->id,
            'title' => 'Section 3: Backpropagation',
            'status' => 'draft',
            'duration_seconds' => 0,
            'sort_order' => 3,
        ]);

        Section::create([
            'course_id' => $course->id,
            'title' => 'Section 4: Model Evaluation',
            'status' => 'draft',
            'duration_seconds' => 0,
            'sort_order' => 4,
        ]);

        Lesson::insert([
            [
                'section_id' => $sectionOne->id,
                'quiz_id' => null,
                'title' => '1.1 What is a Neural Network?',
                'type' => 'video',
                'duration_seconds' => 900,
                'file_size_bytes' => 0,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section_id' => $sectionOne->id,
                'quiz_id' => null,
                'title' => '1.2 Architecture Overview (Slides)',
                'type' => 'pdf',
                'duration_seconds' => 0,
                'file_size_bytes' => 2516582,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $quiz = Quiz::query()->updateOrCreate(
            [
                'user_id' => $instructor->id,
                'title' => 'Module 1 Assessment',
            ],
            [
                'course_id' => $course->id,
                'description' => 'Brief overview of core learning theories.',
                'time_limit_minutes' => 30,
                'passing_score' => 80,
                'status' => 'draft',
            ]
        );

        QuizQuestion::query()->where('quiz_id', $quiz->id)->delete();

        $question = QuizQuestion::create([
            'quiz_id' => $quiz->id,
            'prompt' => 'Which learning theory emphasizes direct instruction?',
            'type' => 'multiple_choice',
            'points' => 10,
            'shuffle_options' => true,
            'sort_order' => 1,
        ]);

        QuizOption::insert([
            ['quiz_question_id' => $question->id, 'text' => 'Direct Instruction', 'is_correct' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_question_id' => $question->id, 'text' => 'Constructivism', 'is_correct' => false, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['quiz_question_id' => $question->id, 'text' => 'Connectivism', 'is_correct' => false, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Submission::query()->whereIn('quiz_id', Quiz::pluck('id'))->delete();

        $quizTitles = [
            ['title' => 'Advanced CSS Layouts', 'module' => 'Module 4'],
            ['title' => 'JavaScript Fundamentals', 'module' => 'Module 2'],
            ['title' => 'Responsive Design Quiz', 'module' => 'Module 3'],
            ['title' => 'UI Components Test', 'module' => 'Module 5'],
        ];

        $students = [
            ['name' => 'Sarah Jenkins', 'code' => '8492-A', 'score' => 88, 'status' => 'needs_review'],
            ['name' => 'Michael Chen', 'code' => '7721-B', 'score' => 92, 'status' => 'graded'],
            ['name' => 'Emily Rodriguez', 'code' => '9103-C', 'score' => 76, 'status' => 'needs_review'],
            ['name' => 'James Wilson', 'code' => '5534-D', 'score' => 95, 'status' => 'graded'],
        ];

        foreach ($students as $index => $student) {
            Submission::create([
                'quiz_id' => $quiz->id,
                'student_name' => $student['name'],
                'student_code' => $student['code'],
                'module_name' => $quizTitles[$index]['module'],
                'score' => $student['score'],
                'status' => $student['status'],
                'submitted_at' => now()->subHours($index * 6),
            ]);
        }
    }
}
