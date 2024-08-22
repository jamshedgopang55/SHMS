
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
                        <h5>Permissions</h5>
                        <div class="d-flex align-items-center">
                            @can('create permission')
                            <div class="pl-3 border-left btn-new">
                                <a href="{{ url('admin/Permission/create') }}" class="btn btn-primary">Create Permission
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
                                <th>Id</th>
                                <th>Name</th>
                                <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>

                                            @can('update permission')
                                            <td>
                                                <a href="{{ url('admin/Permission/edit/'.$permission->id ) }}" class="edit-icon"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            
                                            @endcan

                                            @can('delete permission')
                    
                                                <form
                                                action="{{route('admin.Permission.destroy')}}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                <input hidden type="text" name="id" value="{{$permission->id}}">

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
                                    
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th >Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection