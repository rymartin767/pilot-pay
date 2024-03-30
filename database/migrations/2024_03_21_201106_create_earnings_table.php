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
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('total_compensation')->nullable();
            $table->unsignedInteger('flight_pay');
            $table->unsignedInteger('profit_sharing');
            $table->unsignedInteger('employer_retirement_contribution');
            $table->unsignedInteger('employer_health_savings_contribution');
            $table->unsignedSmallInteger('days_worked')->nullable();
            $table->string('block_hours_flown')->nullable();
            $table->boolean('is_commuter')->nullable();
            $table->text('report_comment')->fulltext()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
};
