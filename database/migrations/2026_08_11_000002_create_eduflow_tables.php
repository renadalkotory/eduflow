<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('institution');
            $table->string('icon')->default('mortarboard');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('detailed_description')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->string('thumbnail_path')->nullable();
            $table->string('promo_video_url')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('status')->default('draft');
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('time_limit_minutes')->default(30);
            $table->unsignedTinyInteger('passing_score')->default(80);
            $table->string('status')->default('draft');
            $table->timestamps();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quiz_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('type')->default('video');
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->unsignedInteger('file_size_bytes')->default(0);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->text('prompt')->nullable();
            $table->string('type')->default('multiple_choice');
            $table->unsignedSmallInteger('points')->default(10);
            $table->boolean('shuffle_options')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('quiz_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_question_id')->constrained()->cascadeOnDelete();
            $table->string('text');
            $table->boolean('is_correct')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->string('student_name');
            $table->string('student_code');
            $table->string('module_name')->nullable();
            $table->unsignedTinyInteger('score')->default(0);
            $table->string('status')->default('needs_review');
            $table->text('feedback')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('quiz_options');
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('credentials');
    }
};
