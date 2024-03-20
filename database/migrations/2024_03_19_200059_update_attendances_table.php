<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Drop the existing attendance_status column
            $table->dropColumn(['attendance_status']);
            $table->enum('check_in_status', ['late', 'on_time'])->after('total_work_time');
            $table->enum('check_out_status', ['on_time', 'early_out'])->nullable()->after('check_in_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Drop the newly added columns
            $table->dropColumn(['check_in_status', 'check_in_out']);

            // Add back the original attendance_status column
            $table->enum('attendance_status', ['present', 'late', 'half_day', 'early_out', 'absent'])->default('absent')->change();
        });
    }
}
