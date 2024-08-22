

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
                        <h5>Roles</h5>
                        <div class="d-flex align-items-center">
                            {{-- @can('create workFromHomePermission') --}}
                            <div class="pl-3 border-left btn-new">
                                <a href="{{route('admin.roles.create')}}" class="btn btn-primary">Create New Role
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

                                @foreach ($Roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{ $role->name }}</td>

                                            {{-- @can('update workFromHomePermission') --}}
                                            <td>
                                                <a href="{{route('admin.roles.edit',$role->id)}}" class="edit-icon"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            
                                            {{-- @endcan --}}

                                            {{-- @can('delete workFromHomePermission') --}}
                                          

                                                <form
                                                action="{{ route('admin.roles.destroy', $role->id) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit"  class="delete-icon"
                                                onclick="return confirm('Are you sure you want to delete this permission?')"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                                <a href="{{ url('admin/roles/'.$role->id.'/give-permissions') }}" class="btn btn-primary">Permission</a>
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
