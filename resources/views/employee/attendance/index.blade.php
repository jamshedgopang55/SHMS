@extends('employee.layout.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Attendance</h5>
                    @if (Auth::guard('employee')->check())
    <p class="mb-0 p-0 px-3">Welcome, <b> {{ Auth::guard('employee')->user()->name }} </b></p>
    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">


    @if (Auth::guard('employee')->check())


    {{-- Check if attendance data exists --}}
    @if ($attendance)
        {{-- Check if the attendance record belongs to the logged-in user --}}
        @if ($attendance->uid === Auth::guard('employee')->user()->id)
            {{-- Check if the user is required to check-in or check-out --}}
            @if ($attendance->attendance_status === 'absent')
                <h2>Check-in</h2>
                <form action="{{ route('employee.attendance.checkin') }}" method="POST">
                    @csrf
                    <label hidden for="checkin_employee_id">Employee ID:</label>
                    <input hidden type="text" id="checkin_employee_id" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}" required readonly>
                    <button class="btn btn-primary" type="submit">Check-in</button>
                </form>
            @elseif  (($attendance->attendance_status === 'present' || $attendance->attendance_status === 'late' || $attendance->attendance_status === 'half_day')   && is_null($attendance->out_time))
                {{-- Only show the "Check-out" button if the user is present or late --}}
                <h4 class="mb-4">Check-out</h4>
                <form action="{{ route('employee.attendance.checkout') }}" method="POST">
                    @csrf
                    <label hidden for="checkout_employee_id">Employee ID:</label>
                    <input hidden type="text" id="checkout_employee_id" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}" required readonly>
                    <button class="btn btn-danger"  type="submit">Check-out</button>
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
        <h4 class="mb-4">Check-in</h4>
        <form action="{{ route('employee.attendance.checkin') }}" method="POST">
            @csrf
            <label hidden for="checkin_employee_id">Employee ID:</label>
            <input hidden  type="text" id="checkin_employee_id" name="employee_id" value="{{ Auth::guard('employee')->user()->id }}" required readonly>

            <button type="submit" class="btn btn-primary">Check-in</button>
        </form>
    @endif

@else
    <p>Please log in to access attendance features.</p>
@endif


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
