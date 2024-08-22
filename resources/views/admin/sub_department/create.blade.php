@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                   <h4 class="card-title">Create Sub Department</h4>
                </div>
             </div>

            <div class="card-body">
                <form action="{{route('admin.subdepartment.store')}}" method="POST">
                    @csrf
                    <div class="row">
                    <div  class="form-group col-md-6">
                        <label >Sub Department Name</label>
                        <input required name="name" placeholder="Name ..." class="form-control">
                    </div>
                    <div  class="form-group col-md-6">
                        <label for="" class="form-label">Department</label>
                        <select
                            class="form-select form-control form-select-lg"
                            name="department_id" required

                        >
                        @foreach ($departments as $depart)
                            <option value="{{$depart->id}}" selected>{{$depart->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-12 pt-3">

                        <button type="submit" class="btn btn-primary">Create Sub Department</button>
                    </div>
                        </div>

                    @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </form>
            </div>
        </div>

    </div>
 </div>

@endsection

