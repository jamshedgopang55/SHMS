@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Edit Admin</h5>
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
                    <form method="post" action="{{ route('admin.user.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $user->name }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ $user->email }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                                <small class="form-text text-muted">Leave blank if you don't want to change the
                                    password.</small>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" class="form-control" id="phone"
                                    value="{{ $user->phone }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="roles">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    @php
                                        $userRoles = $user->roles->pluck('name')->toArray(); // Convert roles to array of names
                                    @endphp
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            @if (in_array($role, $userRoles)) selected @endif>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="schedules">Schedules</label>
                                <select name="schedules" class="form-control">
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}"
                                            @if ($schedule->id == $user->schedule_id) selected @endif>{{ $schedule->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
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
                                <button type="submit" class="btn btn-primary p-2">Update Admin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
