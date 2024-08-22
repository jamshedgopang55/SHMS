

@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
             @endif
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Departments</h5>
                        <div class="d-flex align-items-center">
                            {{-- @can('create workFromHomePermission') --}}
                            <div class="pl-3 border-left btn-new">
                                <a href="{{route('admin.department.create')}}" class="btn btn-primary">Create New Department
                                    </a>
                            </div>
                            {{-- @endcan --}}

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
                                <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $department)
                                    <tr>
                                        <td>{{$department->id}}</td>
                                        <td>{{ $department->name }}</td>

                                            {{-- @can('update workFromHomePermission') --}}
                                            <td class="flex-td">
                                                @can('update deparment')
                                                <a href="{{route('admin.department.edit',['id'=> $department->id])}}" class="btn btn-primary">
                                                    Edit
                                                </a>
                                                @endcan
                                                @can('delete deparment')
                                                <form action="{{route('admin.department.destroy')}}" method="POST">
                                                    <input hidden type="text" name="id" value="{{$department->id}}">
                                                    <input class="btn btn-danger" type="submit" value="delete">
                                                </form>
                                                @endcan
                                            </td>
                                            {{-- @endcan --}}

                                            {{-- <td>
                                            </td> --}}

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                <th>Name</th>
                                <th >Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
