<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->down();
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('edu_date')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('competencies', function (Blueprint $table) {
            $table->id();            
            $table->string('softskills');
            $table->string('techskills');
            $table->timestamps();            
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->tinyText('exp_date');
            $table->tinyText('workplace');
            $table->tinyText('position');
            $table->text('description');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
        Schema::dropIfExists('competencies');
        Schema::dropIfExists('experiences');
        // Schema::dropIfExists('userdetails');
    }
};
