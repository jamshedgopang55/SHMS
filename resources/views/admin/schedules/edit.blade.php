<div class="container">
    <h2>Edit Schedule</h2>
    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $schedule->title }}">
        </div>
        <div class="form-group">
            <label for="start_time">In Time:</label>
            <input type="time" class="form-control" id="start_time" name="start_datetime" value="{{ $schedule->start_datetime }}">
        </div>
        <div class="form-group">
            <label for="end_time">Out Time:</label>
            <input type="time" class="form-control" id="end_time" name="end_datetime" value="{{ $schedule->end_datetime }}">
        </div>
        <!-- Add more fields as needed -->

        <div class="form-group">
            <label for="late_time">Late time:</label>
            <input type="time" class="form-control" id="late_time" name="late_time"  value="{{ $schedule->late_time }}">
        </div>

        <div class="form-group">
            <label for="half_day_time">Half_day_time:</label>
            <input type="time" class="form-control" id="half_day_time" name="half_day_time"  value="{{ $schedule->half_day_time }}">
        </div>



        <button type="submit" class="btn btn-primary">Update Schedule</button>
    </form>
</div>