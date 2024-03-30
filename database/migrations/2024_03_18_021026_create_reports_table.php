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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('employer');
            $table->string('employer_logo_url')->nullable();
            $table->string('wage_year');
            $table->string('longevity');
            $table->string('fleet');
            $table->string('seat');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->unique(['user_id', 'employer', 'wage_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
