@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
             <div class="header-title">
                <h4 class="card-title">Edit Schedule</h4>
             </div>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="title">Title</label>
                        <input type="title" id="title" name="title" class="form-control" value="{{ $schedule->title }}" required>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="start_datetime">In Time:</label>
                        <input type="time" id="start_datetime" name="start_datetime" class="form-control" required value="{{ $schedule->start_datetime }}">
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="end_datetime">Out Time:</label>
                        <input type="time" id="end_datetime" name="end_datetime" class="form-control" required value="{{ $schedule->end_datetime }}">
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="late_time">Late time:</label>
                        <input type="time" id="late_time" name="late_time" class="form-control" required value="{{ $schedule->late_time }}">
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="half_day_time">Half Day Time:</label>
                        <input type="time" id="half_day_time" name="half_day_time" class="form-control" required  value="{{ $schedule->half_day_time }}">
                    </div>
                  
                </div>
                    
              
                <button type="submit" class="btn btn-primary">Update Schedule</button>
            </form>
          </div>
        </div>
      
    </div>
 </div>

@endsection

