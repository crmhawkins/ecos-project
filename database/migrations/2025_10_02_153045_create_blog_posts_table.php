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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('category');
            $table->json('tags')->nullable();
            $table->boolean('published')->default(false);
            $table->datetime('published_at')->nullable();
            $table->unsignedBigInteger('author_id');
            
            // Campos SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            
            // Estadísticas
            $table->integer('views_count')->default(0);
            $table->integer('reading_time')->nullable(); // en minutos
            
            $table->timestamps();
            
            // Índices
            $table->index(['published', 'published_at']);
            $table->index('category');
            $table->index('slug');
            // $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};