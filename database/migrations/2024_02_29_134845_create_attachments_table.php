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

        // if (!Schema::hasTable('attachments')) {
         Schema::create('attachments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
    $table->unsignedBigInteger('temp_id')->nullable(); // Define temp_id column
    $table->foreign('temp_id')->references('id')->on('temp_files')->onDelete('cascade');
    $table->string('source', 255);
    $table->timestamps();
});

        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};