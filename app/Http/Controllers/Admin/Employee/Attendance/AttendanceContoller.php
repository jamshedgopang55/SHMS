<?php

namespace App\Http\Controllers\Admin\Employee\Attendance;

use App\Models\Schedule;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceContoller extends Controller
{
    public function index()
    {
        $attendance = Attendance::where('uid', Auth::guard('employee')->user()->id)
            ->whereDate('date', now()->toDateString())
            ->first();
        return view('employee.attendance.index', ['attendance' => $attendance]);
    }
    public function checkin(Request $request)
    {
        // Get the currently authenticated employee
        $employee = auth()->guard('employee')->user();

        // Check if the employee is already checked in for today
        $attendance = Attendance::where('uid', $employee->id)
            ->whereDate('date', today())
            ->first();

        if (!$attendance) {
            // Get the employee's schedule
            $schedule = Schedule::find($employee->schedule_id);

            // Calculate the expected check-in time
            $expectedCheckin = now()->setTimeFromTimeString($schedule->start_datetime);

            // Calculate the difference in minutes between the actual check-in time and the expected check-in time
            $lateMinutes = max(0, now()->diffInMinutes($expectedCheckin));

            // Determine the check-in status based on late arrival or on-time arrival
            $checkinStatus = ($lateMinutes > 0) ? 'late' : 'on_time';

            // Determine if the employee's check-in qualifies as a half-day based on the half-day threshold defined in the schedule
            $halfDayThreshold = now()->setTimeFromTimeString($schedule->half_day_time);
            $isHalfDay = now()->greaterThan($halfDayThreshold);

            // Determine the attendance status based on the check-in time
            $attendanceStatus = $isHalfDay ? 'half_day' : 'present';

            // Create a new attendance record for check-in
            $attendance = new Attendance();
            $attendance->uid = $employee->id;
            $attendance->in_time = now(); // Set the current time as check-in time
            $attendance->check_in_status = $checkinStatus;
            $attendance->attendance_status = $attendanceStatus;
            $attendance->user_ip = $request->ip();
            $attendance->date = today();
            $attendance->save();

            // Redirect the employee to a success page
            return redirect()->back()->with('success', 'Check-in successful!');
        }

        // Redirect the employee back to the attendance page with an error message
        return redirect()->back()->with('error', 'You have already checked in for today.');
    }




    public function checkout(Request $request)
    {
        // Get the currently authenticated employee
        $employee = auth()->guard('employee')->user();

        // Find the attendance record for the employee's check-out
        $attendance = Attendance::where('uid', $employee->id)
            ->whereDate('date', today())
            ->first();


        if ($attendance) {
            // Update the check-out time
            $attendance->out_time = now(); // Set the current time as check-out time

            // Fetch the employee's schedule
            $schedule = Schedule::find($employee->schedule_id);




            if ($schedule) {
                // Parse in_time, out_time, and end_time using Carbon
                $checkInTime = \Carbon\Carbon::parse($attendance->in_time);
                $checkOutTime = \Carbon\Carbon::parse($attendance->out_time);
                $endTime = \Carbon\Carbon::parse($schedule->end_datetime);

                if ($checkOutTime->lt($endTime)) {
                    // If the employee checks out before the scheduled end time, set check-out status as 'early_out'
                    $attendance->check_out_status = 'early_out';
                } else {
                    // If the employee checks out on or after the scheduled end time, set check-out status as 'on_time'
                    $attendance->check_out_status = 'on_time';
                }
            } else {
                // If the employee's schedule is not found, set check-out status as 'early_out'
                $attendance->check_out_status = 'early_out';
            }
            Log::info('Check Out Time: ' . $checkOutTime);
            Log::info('End Time: ' . $endTime);
            // Calculate the total work time in seconds
            $totalWorkTime = $checkOutTime->diffInSeconds($checkInTime);

            // Save the total work time to the attendance record
            $attendance->total_work_time = $totalWorkTime;

            $attendance->save();

            // Redirect the employee to a success page or back to the attendance page
            return redirect()->back()->with('success', 'Check-out successful!');
        }

        // Redirect the employee back to the attendance page with an error message
        return redirect()->back()->with('error', 'You have not checked in for today.');
    }
}
