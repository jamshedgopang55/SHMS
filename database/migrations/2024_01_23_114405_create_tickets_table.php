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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('department_id');
            $table->integer('sub_department_id')->nullable();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('subject', 255);
            $table->text('description');
            $table->string('priority', 50);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
