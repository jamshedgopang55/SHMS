
@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>create Admin</h5>
                        <div class="d-flex align-items-center">
                            <div class="pl-3 border-left btn-new">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">

                <div class="card-body">

                    <form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden name="id" id="">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Name</label>
                                <input type="name" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="Password" name="password"class="form-control" id="Password">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone"class="form-control" id="name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="">Schedules</label>
                                <select name="schedules" class="form-control">
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}">{{ $schedule->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input"
                                            id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>



                            <div class="col mt-3">
                                <button type="submit " class="btn btn-primary p-2">Create Admin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
