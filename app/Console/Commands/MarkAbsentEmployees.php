<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Console\Command;

class MarkAbsentEmployees extends Command
{
    protected $signature = 'mark:absent-employees';
    protected $description = 'Mark absent employees if they have no attendance record for today';

    public function handle()
    {
        // Get today's date
        $today = Carbon::today();

        // Check if today is Sunday
        if ($today->isSunday()) {
            // Create records for all employees for Sunday
            $employees = Employee::all();
            foreach ($employees as $employee) {
                $attendance = new Attendance();
                $attendance->uid = $employee->id;
                $attendance->date = $today;
                $attendance->check_in_time = null;
                $attendance->check_out_time = null;
                $attendance->check_in_status = null;
                $attendance->check_out_status = null;
                $attendance->attendance_status = 'holiday';
                $attendance->save();
            }
            $this->info('Sunday marked as holiday for all employees.');
            return;
        }

        // If it's not Sunday, proceed with marking absent employees
        $employees = Employee::all();

        // Check attendance for each employee
        foreach ($employees as $employee) {
            // Check if the employee has attendance for today
            $attendance = Attendance::where('uid', $employee->id)
                ->whereDate('date', $today)
                ->first();

            // If no attendance record exists, mark the employee as absent
            if (!$attendance) {
                $absentAttendance = new Attendance();
                $absentAttendance->uid = $employee->id;
                $absentAttendance->date = $today;
                $absentAttendance->attendance_status = 'absent';
                $absentAttendance->save();
            }
        }

        $this->info('Absent employees marked successfully.');
    }
}
