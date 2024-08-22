<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UsersAttendance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UsersAttendanceController extends Controller
{
    public function index()
    {
        $attendance = UsersAttendance::where('uid', Auth::user()->id)
            ->whereDate('date', now()->toDateString())
            ->first();
        return view('admin.user.attendance.index', ['attendance' => $attendance]);
    }
    public function checkin(Request $request)
    {

        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the user is already checked in for today
        $attendance = UsersAttendance::where('uid', $user->id)
            ->whereDate('date', today())
            ->first();
        // return $attendance;
        if (!$attendance) {
            // Get the user's schedule
            $schedule = Schedule::find($user->schedule_id);

            // Calculate the expected check-in time
            $expectedCheckin = now()->setTimeFromTimeString($schedule->start_datetime);

            // Calculate the difference in minutes between the actual check-in time and the expected check-in time
            $lateMinutes = max(0, now()->diffInMinutes($expectedCheckin));

            // Determine the check-in status based on late arrival or on-time arrival
            $checkinStatus = ($lateMinutes > 0) ? 'late' : 'on_time';

            // Determine if the user's check-in qualifies as a half-day based on the half-day threshold defined in the schedule
            $halfDayThreshold = now()->setTimeFromTimeString($schedule->half_day_time);
            $isHalfDay = now()->greaterThan($halfDayThreshold);

            // Determine the attendance status based on the check-in time
            $attendanceStatus = $isHalfDay ? 'half_day' : 'present';

            // Create a new attendance record for check-in
            $attendance = new UsersAttendance();
            $attendance->uid = $user->id;
            $attendance->in_time = now(); // Set the current time as check-in time
            $attendance->check_in_status = $checkinStatus;
            $attendance->attendance_status = $attendanceStatus;
            $attendance->user_ip = $request->ip();
            $attendance->date = today();
            $attendance->save();

            // Redirect the user to a success page
            return redirect()->back()->with('success', 'Check-in successful!');
        }

        // Redirect the user back to the attendance page with an error message
        return redirect()->back()->with('error', 'You have already checked in for today.');
    }




    public function checkout(Request $request)
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Find the attendance record for the user's check-out
        $attendance = UsersAttendance::where('uid', $user->id)
            ->whereDate('date', today())
            ->first();


        if ($attendance) {
            // Update the check-out time
            $attendance->out_time = now(); // Set the current time as check-out time

            // Fetch the user's schedule
            $schedule = Schedule::find($user->schedule_id);




            if ($schedule) {
                // Parse in_time, out_time, and end_time using Carbon
                $checkInTime = \Carbon\Carbon::parse($attendance->in_time);
                $checkOutTime = \Carbon\Carbon::parse($attendance->out_time);
                $endTime = \Carbon\Carbon::parse($schedule->end_datetime);

                if ($checkOutTime->lt($endTime)) {
                    // If the user checks out before the scheduled end time, set check-out status as 'early_out'
                    $attendance->check_out_status = 'early_out';
                } else {
                    // If the user checks out on or after the scheduled end time, set check-out status as 'on_time'
                    $attendance->check_out_status = 'on_time';
                }
            } else {
                // If the user's schedule is not found, set check-out status as 'early_out'
                $attendance->check_out_status = 'early_out';
            }
            Log::info('Check Out Time: ' . $checkOutTime);
            Log::info('End Time: ' . $endTime);
            // Calculate the total work time in seconds
            $totalWorkTime = $checkOutTime->diffInSeconds($checkInTime);

            // Save the total work time to the attendance record
            $attendance->total_work_time = $totalWorkTime;

            $attendance->save();

            // Redirect the user to a success page or back to the attendance page
            return redirect()->back()->with('success', 'Check-out successful!');
        }

        // Redirect the user back to the attendance page with an error message
        return redirect()->back()->with('error', 'You have not checked in for today.');
    }
    public function list(){
        $attendances = UsersAttendance::latest()->get();

        return view('admin.user.attendance.list', compact('attendances'));
    }
    public function show($user_id)
    {
        // Find the user
        $user = User::findOrFail($user_id);

        // Fetch all attendance records for the user
        $attendances = UsersAttendance::with('user')->where('uid', $user->id)->get();

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

                // Fetch attendance record for the user on the current date
                $attendance = UsersAttendance::where('uid', $user->id)
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
        // return $attendances;
        // Pass the calculated values to the view
        return view('admin.attendance.adminShow', compact(
            'attendances',
            'user',
            'totalOfficeDays',
            'presentDays',
            'onTimeCount',
            'lateCount',
            'earlyOutCount',
            'halfDayCount' // Add half day count to the compact function
        ));
    }
    
}
