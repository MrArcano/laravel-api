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
        Schema::create('project_tecnology', function (Blueprint $table) {
            // colonna in realzione con project
            $table->unsignedBigInteger('project_id');
            // creazione FK
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onDelete('cascade');/* se viene cancellato un project, viene eliminata la relazione nella tab ponte */

            // colonna in realzione con tecnology
            $table->unsignedBigInteger('tecnology_id');
            // creazione FK
            $table->foreign('tecnology_id')
                    ->references('id')
                    ->on('tecnologies')
                    ->onDelete('cascade');/* se viene cancellato un project, viene eliminata la relazione nella tab ponte */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tecnology');
    }
};
