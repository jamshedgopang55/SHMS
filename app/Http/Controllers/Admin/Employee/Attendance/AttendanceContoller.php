<?php

namespace App\Http\Controllers\Admin\Employee\Attendance;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
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

        // $attendance = Attendance::where('uid',$employee->id)->whereDate('date', today())->first()
        // $attendance = $employee->attendance()->whereDate('date', today())->first();
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

            // Check if the employee is late and if the late time exceeds a certain threshold for half-day
            $halfDayThreshold = $schedule->half_day_time; // Define the threshold in the schedule
            if ($lateMinutes > 0 && $lateMinutes <= $halfDayThreshold) {
                // Mark the attendance as half-day
                $attendanceStatus = 'half_day';
            } elseif ($lateMinutes > $halfDayThreshold) {
                // Mark the attendance as late arrival (beyond half-day threshold)
                $attendanceStatus = 'late';
            } else {
                // Mark the attendance as present if not late
                $attendanceStatus = 'present';
            }

            // Create a new attendance record for check-in
            $attendance = new Attendance();
            $attendance->uid = $employee->id;
            $attendance->in_time = now(); // Set the current time as check-in time
            $attendance->attendance_status = $attendanceStatus;
            $attendance->out_time = null;
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
    
            // Parse in_time and out_time using Carbon
            $checkInTime = \Carbon\Carbon::parse($attendance->in_time);
            $checkOutTime = \Carbon\Carbon::parse($attendance->out_time);
    
            // Calculate the total work time
            $totalWorkTime = $checkOutTime->diffInMinutes($checkInTime);
    
            // Fetch the employee's schedule
            $schedule = Schedule::find($employee->schedule_id);

    
            if ($schedule && isset($schedule->early_out_threshold)) {
                // Check if the employee left early based on the early out threshold
                $earlyOutThreshold = $schedule->early_out_threshold;
                if ($totalWorkTime < $schedule->working_hours && $totalWorkTime < $earlyOutThreshold) {
                    $attendance->attendance_status = 'early_out';
                } else {
                    // Update the attendance status as present if not early out
                    $attendance->attendance_status = 'present';
                }
            } else {
                // If the employee doesn't have a schedule or early_out_threshold is not set, set the attendance status as present
                $attendance->attendance_status = 'present';
            }
    
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
