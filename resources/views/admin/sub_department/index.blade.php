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
                        <h5>Sub Departments</h5>
                        <div class="d-flex align-items-center">
                            {{-- @can('create workFromHomePermission') --}}
                            <div class="pl-3 border-left btn-new">
                                <a href="{{route('admin.subdepartment.create')}}" class="btn btn-primary">Create New Sub Department
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
                                <th>Sub Department</th>
                                <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $subdepartment)
                                    <tr>
                                        <td>{{$subdepartment->id}}</td>
                                        <td>{{ $subdepartment->name }}</td>
                                        <td>{{ optional($subdepartment->department)->name ?? 'N/A' }}</td>

                                            {{-- @can('update workFromHomePermission') --}}
                                            <td class="flex-td">
                                                {{-- @can('update deparment') --}}
                                                <a href="{{route('admin.subdepartment.edit',['id'=> $subdepartment->id])}}" class="btn btn-primary">
                                                    Edit
                                                </a>
                                                {{-- @endcan --}}
                                                {{-- @can('delete deparment') --}}
                                                <form action="{{route('admin.subdepartment.destroy')}}" method="POST">
                                                    <input hidden type="text" name="id" value="{{$subdepartment->id}}">
                                                    <input class="btn btn-danger" type="submit" value="delete">
                                                </form>
                                                {{-- @endcan --}}
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
                                <th>Sub Department</th>
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

