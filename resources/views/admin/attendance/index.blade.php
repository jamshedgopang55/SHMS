@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Attendances</h5>
                        <div class="d-flex align-items-center">

                            <div class="pl-3 border-left btn-new">
                                <a href="" class="btn btn-primary" data-target="#new-user-modal" data-toggle="modal">New
                                    Attendance</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                            <thead>
                                <tr class="ligth">
                                    <th>Date</th>
                                    <th>Employee Id</th>
                                    <th>Name</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Work Time</th>
                                    <th>Attendance Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('l, d-M-Y') }}</td>
                                        <td>{{ $attendance->uid }}</td>
                                        <td>{{ $attendance->employee->name }}</td>
                                        @if ($attendance->attendance_status == 'absent')
                                            <td style="color: red;">Absent</td>
                                            <td style="color: red;">Absent</td>
                                            <td style="color: red;">Absent</td>
                                            <td style="color: red;">Absent</td>
                                            <!-- Add an extra cell for the attendance status -->
                                        @elseif ($attendance->attendance_status == 'holiday')
                                            <td style="color: green;">Holiday</td>
                                            <td style="color: green;">Holiday</td>
                                            <td style="color: green;">Holiday</td>
                                            <td style="color: green;">Holiday</td>
                                            <!-- Add an extra cell for the attendance status -->
                                        @else
                                            <td
                                                style="color: {{ $attendance->check_in_status == 'late' ? 'red' : 'green' }}">
                                                {{ $attendance->in_time }} ({{ $attendance->check_in_status }})</td>
                                            <td
                                                style="color: {{ $attendance->check_out_status == 'late' ? 'red' : 'green' }}">
                                                {{ $attendance->out_time }} ({{ $attendance->check_out_status }})</td>
                                            <td>{{ $attendance->total_work_time }}</td>
                                            <td style="color: green;">{{ ucfirst($attendance->attendance_status) }}</td>
                                            <!-- If attendance status is neither absent nor holiday, it will show the status in green -->
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee Id</th>
                                    <th>Name</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Work Time</th>
                                    <th>Attendance Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
