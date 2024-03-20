
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Work from Home Permission</div>

                    <div class="card-body">
                        <form action="{{ route('admin.attendance.permissions.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Create Permission</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

