@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
             @endif
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Schedules</h5>
                        <div class="d-flex align-items-center">
                            {{-- @can('create workFromHomePermission') --}}
                            <div class="pl-3 border-left btn-new">
                                <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">Create Schedule
                                    </a>
                            </div>
                            {{-- @endcan --}}

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
                                <th>Title</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>late Time</th>
                                <th>half day Time</th>
                                <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->title }}</td>
                                        <td>{{ $schedule->start_datetime }}</td>
                                        <td>{{ $schedule->end_datetime }}</td>
                                        <td>{{ $schedule->late_time }}</td>
                                        <td>{{ $schedule->half_day_time }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.schedules.show', $schedule->id) }}" class="btn btn-info">View</a> --}}
                                            <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>late Time</th>
                                    <th>half day Time</th>
                                    <th >Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
