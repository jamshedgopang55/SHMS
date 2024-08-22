{{-- <div class="container">
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
 --}}



@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
       <div class="card">
          <div class="card-header d-flex justify-content-between">
             <div class="header-title">
                <h4 class="card-title">Create Schedule</h4>
             </div>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.schedules.store') }}" method="POST">

                @csrf


                <div class="row">
                    <div class="form-group col-md-6" >
                        <label for="title">Title</label>
                        <input type="title" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="start_datetime">In Time:</label>
                        <input type="time" id="start_datetime" name="start_datetime" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="end_datetime">Out Time:</label>
                        <input type="time" id="end_datetime" name="end_datetime" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="late_time">Late time:</label>
                        <input type="time" id="late_time" name="late_time" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="half_day_time">Half Day Time:</label>
                        <input type="time" id="half_day_time" name="half_day_time" class="form-control" required>
                    </div>
                  
                </div>
                    
              
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      
    </div>
 </div>

@endsection
