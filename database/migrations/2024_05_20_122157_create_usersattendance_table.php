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
        Schema::create('usersattendance', function (Blueprint $table) {
            $table->id(); // Primary key, unsigned bigint, auto-increment
            $table->string('user_ip', 45)->nullable(); // User IP, varchar(45), nullable
            $table->unsignedBigInteger('uid'); // User ID, unsigned bigint
            $table->time('in_time')->nullable(); // In-time, nullable
            $table->time('out_time')->nullable(); // Out-time, nullable
            $table->time('total_work_time')->nullable(); // Total work time, nullable
            $table->enum('check_in_status', ['late', 'on_time'])->default('on_time'); // Check-in status, enum
            $table->enum('check_out_status', ['on_time', 'early_out'])->nullable(); // Check-out status, enum, nullable
            $table->date('date')->default(date("Y-m-d")); // Date, default value
            $table->timestamp('created_at')->nullable(); // Created at, timestamp, nullable
            $table->timestamp('updated_at')->nullable(); // Updated at, timestamp, nullable
            $table->enum('attendance_status', ['present', 'half_day', 'absent', 'holiday'])->default('present'); // Attendance status, enum

            // Add a foreign key constraint if the users table exists
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usersattendance');
    }
};
