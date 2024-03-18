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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->integer('department_id');
            $table->integer('sub_department_id')->nullable();
            $table->integer('position_id');
            $table->string('name',50);
            $table->string('password',255);
            $table->string('email',50);
            $table->string('phone',50);
            $table->string('pic',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
