@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Admin</h5>
                        <div class="d-flex align-items-center">

                            <div class="pl-3 border-left btn-new">
                                <a href="{{route('admin.user.create')}}" class="btn btn-primary">New
                                    Admin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                            <thead>
                                <tr class="ligth">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>role</th>
                                    <th>Attendance</th>
                                    <th>Pic</th>
                                    <th>Action</th>
                                   

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $user)
                                      <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                            @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $rolename)
                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td><a href="{{route('admin.UsersAttendance.show',$user->id)}}">Attendace</a></td>
                           
                               
                           
                            <td>
                                <img src="{{ asset($user->pic) }}" alt="Profile Picture"
                                    style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                                @can('update user')
                                <a href="{{ url('admin/user/edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                @endcan
                                @can('delete user')
                                <a href="{{ url('admin/user/destory', $user->id) }}" class="btn btn-danger">Delete</a>
                                @endcan
                            </td>
                        </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr class="ligth">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>role</th>
                                    <th>Attendance</th>
                                    <th>Pic</th>
                                    <th>Action</th>
                                   

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection
