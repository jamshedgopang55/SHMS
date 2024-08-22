{{-- <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Role : {{ $role->name }}
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/roles/'.$role->id.'/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @error('permission')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="">Permissions</label>

                            <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-md-2">
                                    <label>
                                        <input
                                            type="checkbox"
                                            name="permission[]"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                        />
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





 --}}





@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Role : {{ $role->name }}</h5>
                    <div class="d-flex align-items-center">
                        @can('create workFromHomePermission')
                        <div class="pl-3 border-left btn-new">
                            <a href="{{ url('admin/roles/') }}" class="btn btn-primary">Back
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
    <div class="col-md-12">

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card">
            
            <div class="card-body">

                <form action="{{ url('admin/roles/'.$role->id.'/give-permissions') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label class="mb-3" style="font-weight: bold">Permissions</label>
                        

                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-4">
                                <label style="display: flex;
                                align-items: center;
                                gap: 5px;">
                                    <input 
                                        type="checkbox"
                                        name="permission[]"
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                        style="width: 20px;
                                        height: 17px"
                                    />
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

