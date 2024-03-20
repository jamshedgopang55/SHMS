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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uid')->references('id')->on('employees')->onDelete('cascade');
            $table->time('in_time')->default(date("H:i:s"))->nullable();
            $table->time('out_time')->default(date("H:i:s"))->nullable();
            $table->time('total_work_time')->nullable();
            $table->enum('attendance_status', ['present', 'late', 'half_day', 'early_out', 'absent'])->default('absent');
            $table->date('date')->default(date("Y-m-d"));
            $table->timestamps();   
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
