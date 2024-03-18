

@extends('admin.layout.app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Edit Employee</h5>
                    <div class="d-flex align-items-center">
                     
                        <div class="pl-3 border-left btn-new">
                        <a href="{{route('admin.Employee.index')}}" class="btn btn-primary" >Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12 col-lg-12">
        <div class="card">
            
                <div class="card-body">

                    <form method="post" action="{{ route('admin.Employee.update') }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden name="id" id="" value="{{ $employee->id }}">

                        <div class="row">
                            <div  class="form-group col-md-6">
                                <label for="email">Employee Name</label>
                                <input type="name" name="name" class="form-control" id="name" value="{{ $employee->name }}">
                            </div>
                            <div  class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $employee->email }}">
                            </div>
                            <div  class="form-group col-md-6">
                                <label for="email">Phone</label>
                                <input type="phone" name="phone" value="{{ $employee->phone }}" class="form-control" id="name">
                            </div>
                            
                            <div  class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="name">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Select Schedule</label>
                                <select class="form-control mb-2" name="schedule_id" id="schedule_id">
                                    @foreach ($schedules as $schedule)
                                        <option {{ $employee->schedule_id == $schedule->id ? 'selected' : '' }} value="{{ $schedule->id }}">{{ $schedule->title }} - {{ $schedule->start_datetime }} to {{ $schedule->end_datetime }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div  class="form-group col-md-6">
                                <label for="joining_date">Joining Date</label>
                                <input type="date" name="joining_date" class="form-control" id="name" value="{{$employee->joining_date}}"> 
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select class="form-control mb-2" name="department_id" id="department_id">
                                    @foreach ($departments as $department)
                                        <option {{ $employee->department_id == $department->id ? 'selected' : '' }}
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sub Department</label>
                                <select name="sub_department_id" id="sub_department" class="form-control  mb-2">
                                    @foreach ($sub_departments as $sub_department)
                                        <option {{ $employee->sub_department_id == $sub_department->id ? 'selected' : '' }}
                                            value="{{ $sub_department->id }}">{{ $sub_department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Position</label>
                                <select class="form-control mb-3" name="position_id" id="position">
                                    @foreach ($positions as $position)
                                        <option {{ $employee->position_id == $position->id ? 'selected' : '' }}
                                            value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group col-md-6">
                                <div class="preview-image">
                                    <img src="{{ asset($employee->pic) }}" alt="Profile Picture"
                                     style="max-width: 100px; max-height: 100px;">
                                </div>
                            </div>
                            <div class="col mt-3">
                                <button type="submit " class="btn btn-primary p-2">Update Employee</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>
    </div>
@endsection

@section('customJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        $('#department_id').change(function() {
            let category_id = $(this).val();
            $.ajax({
                url: "{{ route('get/sub/department') }}",
                type: 'GET',
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    console.log(response);
                    if (response['status'] == true) {
                        // Clear previous options
                        $('#sub_department').empty();
                        $.each(response['subCategories'], function(key, item) {
                            $('#sub_department').append(
                                `<option value='${item.id}'>${item.name}</option>`
                            );
                        });
                    }
                }
            });
        });
    </script>
@endsection
