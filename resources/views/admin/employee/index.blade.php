@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Employees</h5>
                        <div class="d-flex align-items-center">

                            <div class="pl-3 border-left btn-new">
                                <a href="#" class="btn btn-primary" data-target="#new-user-modal" data-toggle="modal">New
                                    Employee</a>
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
                                    <th>Department</th>
                                    <th>Sub Department</th>
                                    <th> Position</th>
                                    <th>Pic</th>
                                    <th>Attendance</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($Employees as $Employee)
                                    <tr>
                                        <td>{{ $Employee->id }}</td>
                                        <td>{{ $Employee->name }}</td>
                                        <td>{{ $Employee->email }}</td>
                                        <td>{{ $Employee->phone }}</td>
                                        <td>{{ optional($Employee->department)->name ?? 'N/A' }}</td>
                                        <td>{{ optional($Employee->subdepartment)->name ?? 'N/A' }}</td>
                                        <td>{{ $Employee->position->name }}</td>
                                        <td><img src="{{ asset($Employee->pic) }}" alt="Profile Picture"
                                                style="max-width: 100px; max-height: 100px;"></td>

                                        <td><a href="{{ route('admin.attendance.show', $Employee->id) }}">Attendace</a></td>
                                        <td>

                                            <a href="{{ url('admin/Employee/edit', $Employee->id) }}" class="edit-icon"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ url('admin/Employee/destory', $Employee->id) }}"
                                                class="delete-icon"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Department</th>
                                    <th>Sub Department</th>
                                    <th>Position</th>
                                    <th>Pic</th>
                                    <th>Attendance</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-user-modal">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="exampleModalCenterTitle02">New Employee</h3>
                </div>
                <div class="modal-body">
                    <form id="employeeForm" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3 custom-file-small">
                                    <label for="exampleInputText01" class="h5">Upload Profile Picture</label>
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input"
                                            id="inputGroupFile02">
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="h5">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter  full name">
                                </div>
                            </div>






                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="h5">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter phone number">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="h5">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter  Email">
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group  mb-3">
                                    <label for="joining_date">Joining Date:</label>
                                    <input type="date" name="joining_date" id="joining_date" class="form-control"
                                        required>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="schedule_id" class="h5">Shift</label>
                                    <select id="schedule_id" class="selectpicker form-control" name="schedule_id"
                                        data-style="py-0">
                                        <option>Please Select Shift</option>
                                        @foreach ($schedules as $schedule)
                                            <option value="{{ $schedule->id }}">{{ $schedule->title }} -
                                                {{ $schedule->start_datetime }} to {{ $schedule->end_datetime }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="h5">Password</label>
                                    <input type="password" class="form-control" id="email" name="password"
                                        placeholder="Enter  password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="department_id" class="h5">Department</label>
                                    <select id="category" class="selectpicker form-control" name="department_id"
                                        data-style="py-0">
                                        <option>Please Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="exampleInputText2" class="h5">Sub Department</label>
                                    <select id="sub_category" name="sub_department_id" class=" form-control"
                                        data-style="py-0">
                                        <option value="">Please Select Sub depart</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="position_id" class="h5">Position</label>
                                    <select name="position_id" name="type" class="selectpicker form-control"
                                        data-style="py-0">
                                        <option>Please Select Position</option>
                                        @foreach ($Position as $Position)
                                            <option value="{{ $Position->id }}">{{ $Position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                            <label for="category">Sub depart</label>
                            <select name="sub_department_id" id="sub_category" class="form-control">
                                <option>Please Select Sub depart</option>
                            </select>
                            </select>
                        </div> --}}
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-2">
                                    <button id="btn" type="submit" class="btn btn-primary mr-3">Save</button>
                                    {{-- <div ></div> --}}
                                    <div id="cancelButton" class="btn btn-primary" data-dismiss="modal">Cancel</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('#employeeForm').submit('click', function(e) {
                $('#btn').attr('disabled', true)
                const data = $(this).serializeArray()

                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.Employee.store') }}",
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        $('#btn').attr('disabled', false)
                        if (response['status']) {
                            $('#cancelButton').click();
                        }
                    }
                })
            })
        })
    </script>
    <script>
        $('#category').change(function() {
            let category_id = $(this).val()
            $.ajax({
                url: "{{ route('get/sub/department') }}",
                type: 'GET',
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    console.log(response)
                    if (response['status'] == true) {
                        $('#sub_category').find('option').not(':first').remove();
                        $.each(response['subCategories'], function(key, item) {
                            console.log(item.name)
                            $('#sub_category').append(
                                `<option value='${item.id}'>${item.name}</option>`)

                        })
                    }
                }
            })
        })
    </script>
@endsection
