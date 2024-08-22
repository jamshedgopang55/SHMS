@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Work from Home Permissions</h5>
                        <div class="d-flex align-items-center">
                            @can('create workFromHomePermission')
                            <div class="pl-3 border-left btn-new">
                                <a href="{{ route('admin.attendance.permissions.create') }}" class="btn btn-primary">New Employee Persmission
                                    </a>
                            </div>
                            @endcan

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
                                <th>#</th>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($permissions as $permission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $permission->employee->name }}</td>
                                        <td>{{ $permission->date }}</td>

                                            @can('update workFromHomePermission')
                                            <td>
                                                <a href="{{ route('admin.attendance.permissions.edit', $permission->id) }}" class="edit-icon"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            
                                            @endcan

                                            @can('delete workFromHomePermission')
                                          

                                                <form
                                                action="{{ route('admin.attendance.permissions.destroy', $permission->id) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"  class="delete-icon"
                                                onclick="return confirm('Are you sure you want to delete this permission?')"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
