<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('professional_title')->nullable();
            $table->text('biography')->nullable();
            $table->string('website_url')->nullable();
            $table->string('profile_picture')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->unsignedInteger('total_students')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'professional_title',
                'biography',
                'website_url',
                'profile_picture',
                'is_verified',
                'total_students',
            ]);
        });
    }
};
