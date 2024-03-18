<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
</head>
<body>
    <h1>Employee Attendance</h1>

    @if (Auth::guard('employee')->check())
        <p>Welcome, {{ Auth::guard('employee')->user()->name }}</p>
        
        {{-- Check if attendance data exists --}}
        @if ($attendance)
            {{-- Check if the attendance record belongs to the logged-in user --}}
            @if ($attendance->uid === Auth::guard('employee')->user()->id)
                {{-- Check if the user is required to check-in or check-out --}}
                @if ($attendance->attendance_status === 'absent')
                    <h2>Check-in</h2>
                    <form action="{{ route('employee.checkin') }}" method="POST">
                        @csrf
                        <label for="checkin_employee_id">Employee ID:</label>
                        <input type="text" id="checkin_employee_id" name="employee_id" value="{{ Auth::user()->id }}" required readonly>
                        <button type="submit">Check-in</button>
                    </form>
                @elseif  (($attendance->attendance_status === 'present' || $attendance->attendance_status === 'late') && is_null($attendance->out_time))
                    {{-- Only show the "Check-out" button if the user is present or late --}}
                    <h2>Check-out</h2>
                    <form action="{{ route('employee.attendance.checkout') }}" method="POST">
                        @csrf
                        <label for="checkout_employee_id">Employee ID:</label>
                        <input type="text" id="checkout_employee_id" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}" required readonly>
                        <button type="submit">Check-out</button>
                    </form>
                @else
                    <p>You are not required to check-in or check-out for today.</p>
                @endif
            {{-- If the attendance data doesn't belong to the logged-in user --}}
            @else
                <p>Attendance data not found for the logged-in user.</p>
            @endif
        {{-- If no attendance data found for today, allow the user to check-in --}}
        @else
            <h2>Check-in</h2>
            <form action="{{ route('employee.attendance.checkin') }}" method="POST">
                @csrf
                <label for="checkin_employee_id">Employee ID:</label>
                <input type="text" id="checkin_employee_id" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}" required readonly>
               
                <button type="submit">Check-in</button>
            </form>
        @endif
        
    @else
        <p>Please log in to access attendance features.</p>
    @endif
</body>
</html>
