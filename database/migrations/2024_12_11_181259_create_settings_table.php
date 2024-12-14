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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable()->default('Divio');
            $table->string('facebook')->nullable()->default('https://facebook.com');
            $table->string('youtube')->nullable()->default('https://youtube.com');
            $table->string('linkedin')->nullable()->default('https://linkedin.com');
            $table->string('github')->nullable()->default('https://github.com');
            $table->string('twitter')->nullable()->default('https://twitter.com');
            $table->text("about_us_content")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
