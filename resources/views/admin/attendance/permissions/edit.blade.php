

@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                   <h4 class="card-title">Edit Work from Home Permission</h4>
                </div>
             </div>

            <div class="card-body">
                <form action="{{ route('admin.attendance.permissions.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $permission->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }} (ID: {{ $employee->id }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $permission->date }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Permission</button>
                </form>
            </div>
        </div>
      
    </div>
 </div>

@endsection

