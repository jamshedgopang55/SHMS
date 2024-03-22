<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Work from Home Permissions</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
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
                                    <td>
                                        @can('create workFromHomePermission')
                                            <a href="{{ route('admin.attendance.permissions.create') }}">create</a>
                                            <br>
                                        @endcan
                                        @can('update workFromHomePermission')
                                            <a href="{{ route('admin.attendance.permissions.edit', $permission->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                        @endcan
                                        @can('delete workFromHomePermission')
                                        <form
                                        action="{{ route('admin.attendance.permissions.destroy', $permission->id) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this permission?')">Delete</button>
                                    </form>
                                          @endcan
                                      
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No work from home permissions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
