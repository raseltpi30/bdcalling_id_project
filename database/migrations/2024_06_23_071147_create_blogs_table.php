<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_category_id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('public_date')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('tag')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->foreign('blog_category_id')->references('id')->on('blog_category')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
