


@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                   <h4 class="card-title">Create Department</h4>
                </div>
             </div>

            <div class="card-body">
                <form action="{{route('admin.department.store')}}" method="POST">
                    @csrf
                    <div  class="form-group">
                        <label >Department Name</label>
                        <input  name="name" placeholder="Name ..." class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Department</button>

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

