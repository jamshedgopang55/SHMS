@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>attendances</h5>
                        <div class="d-flex align-items-center">

                            <div class="pl-3 border-left btn-new">
                                <a href="#" class="btn btn-primary" data-target="#new-user-modal" data-toggle="modal">New
                                    attendance</a>
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
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ $attendance->uid }}</td>
                                         <td>{{ $attendance->employee->name }}</td>
                                        <td>{{ $attendance->in_time }}</td>
                                        <td>{{ $attendance->out_time }}</td>
                                        <td>{{ $attendance->total_work_time }}</td>
                                        
                                        {{-- <td><img src="{{ asset($attendance->pic) }}" alt="Profile Picture"
                                                style="max-width: 100px; max-height: 100px;"></td>


                                        <td>
                                            <a href="{{ url('admin/attendance/edit', $attendance->id) }}" class="edit-icon"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ url('admin/attendance/destory', $attendance->id) }}"
                                                class="delete-icon"><i class="fa-solid fa-trash"></i></a>
                                        </td> --}}
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee Id</th>
                                    <th>Name</th>x
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Work Time</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection