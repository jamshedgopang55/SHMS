<?php

namespace App\Http\Controllers\Admin\Attendance;

use Carbon\Carbon;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::get();

        return view('admin.attendance.index', compact('attendances'));
    }
    public function show($employeeId)
    {
        // Find the employee
        $employee = Employee::findOrFail($employeeId);

        // Fetch all attendance records for the employee
        $attendances = Attendance::where('uid', $employee->id)->get();

        // Get the current date and the first day of the current month
        $currentDate = Carbon::today();
        $firstDayOfMonth = $currentDate->copy()->startOfMonth();

        // Initialize counters
        $totalOfficeDays = 0;
        $presentDays = 0;
        $onTimeCount = 0;
        $lateCount = 0;
        $earlyOutCount = 0;
        $halfDayCount = 0; // Initialize half day counter

        // Iterate through each date from the 1st of the month up to the current date
        $date = $firstDayOfMonth;
        while ($date <= $currentDate) {
            // Check if the current date is not a Sunday
            if ($date->dayOfWeek !== Carbon::SUNDAY) {
                $totalOfficeDays++;

                // Fetch attendance record for the employee on the current date
                $attendance = Attendance::where('uid', $employee->id)
                    ->whereDate('date', $date)
                    ->first();

                // Increment present days if attendance status is not absent or holiday
                if ($attendance && $attendance->attendance_status != 'absent' && $attendance->attendance_status != 'holiday') {
                    if ($attendance->attendance_status == 'half_day') {
                        $halfDayCount++;
                    } else {
                        $presentDays++;
                    }

                    // Check check-in status for on-time
                    if ($attendance->check_in_status == 'on_time' || is_null($attendance->check_in_status)) {
                        $onTimeCount++;
                    } elseif ($attendance->check_in_status == 'late') {
                        $lateCount++;
                    }

                    // Check check-out status for early out
                    if ($attendance->check_out_status == 'early_out') {
                        $earlyOutCount++;
                    }
                }
            }

            // Move to the next day
            $date->addDay();
        }

        // Pass the calculated values to the view
        return view('admin.attendance.show', compact(
            'attendances',
            'employee',
            'totalOfficeDays',
            'presentDays',
            'onTimeCount',
            'lateCount',
            'earlyOutCount',
            'halfDayCount' // Add half day count to the compact function
        ));
    }
}
