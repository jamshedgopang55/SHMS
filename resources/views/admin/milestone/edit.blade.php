@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
       <div class="card">
        <div class="card-header d-flex justify-content-between">
             <div class="header-title">
                <h4 class="card-title">Create MileStone

                </h4>
             </div>
          </div>
          <div class="card-body">
            {{-- <form action="{{ route('admin.milestone.update') }}" method="POST"> --}}
                <form action="{{ route('admin.milestone.update') }}" method="POST">

                @csrf


                <div class="row">
                    <div class="form-group col-md-4" >
                        <label for="title">Project Title</label>
                        <input  readonly type="title" value="{{$project->name}}" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4" >
                        <label for="title">Total Price</label>
                        <input  readonly type="title" value="{{$project->ticket->price }}" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4" >
                        <label for="title">Remaining Price</label>
                        <input  readonly type="title" value="{{$project->ticket->price - $receivedPrice}}" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12" >
                        <label for="start_datetime">Description</label>
                       <textarea required  class="form-control" name="description" id="description    " cols ="30" rows="10">{{$Milestone->description}}</textarea>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="end_datetime">Date</label>
                        <input required type="date" value="{{$Milestone->due_date}}" id="due_date" name="due_date" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6" >
                        <label for="late_time">Price</label>
                        <input required type="number"  value="{{$Milestone->price}}" id="price" name="price" class="form-control" required>
                    </div>
                    <input type="number" style="display: none"  value="{{$Milestone->id}}" name="id">
                </div>
                    
              
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      
    </div>
 </div>

@endsection
