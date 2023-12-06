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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('image')->nullable();
            $table->string('image_name')->nullable();
            $table->string('slug',50)->unique();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description');
            $table->string('is_group_project',2)->nullable()->default('No');
            $table->string('status',10)->nullable()->default('In corso'); /* (in corso, completato, sospeso, etc.) */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
