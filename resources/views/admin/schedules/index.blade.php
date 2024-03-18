<div class="container">
    <h2>Schedules</h2>
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary mb-3">Create Schedule</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>late Time</th>
                <th>half day Time</th>
                <th>Action</th>
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
    </table>
</div>