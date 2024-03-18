<div class="container">
    <h2>Create Schedule</h2>
    <form action="{{ route('admin.schedules.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="start_datetime">In Time:</label>
            <input type="time" class="form-control" id="start_datetime" name="start_datetime">
        </div>

        <div class="form-group">
            <label for="end_datetime">Out Time:</label>
            <input type="time" class="form-control" id="end_datetime" name="end_datetime">
        </div>

        

        <div class="form-group">
            <label for="late_time">Late time:</label>
            <input type="time" class="form-control" id="late_time" name="late_time">
        </div>

        <div class="form-group">
            <label for="half_day_time">Half_day_time:</label>
            <input type="time" class="form-control" id="half_day_time" name="half_day_time">
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
