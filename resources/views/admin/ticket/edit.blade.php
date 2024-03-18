<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
         <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  
    </head>

    <body style="display: grid;place-items:center;">
        
        <div>
            <h1 class="my-4">Employees Departments</h1>

            <form style="max-width:700px" class="border p-5" method="post"  action="{{ route('admin.Employee.update')}}" enctype="multipart/form-data" >
                @csrf
                
<input type="text" hidden name="id" id="" value="{{$employee->id}}">
                <div class="mb-3">
                    
                    <label for="" class="form-label">Employees Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"         
                        value="{{$employee->name}}"      
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Employees Email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"     
                        value="{{$employee->email}}"                
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Employees phone</label>
                    <input
                        type="text"
                        class="form-control"
                        name="phone"     
                        value="{{$employee->phone}}"                
                    />
                </div>
              
                <div class="mb-3">
                    <label for=""  class="form-label">Departments</label>
                    
                    <select
                        class="form-select form-select-lg"
                        name="department_id" id="category"
                    >
              
                    @foreach ($departments as $department)
                    <option {{ $employee->department_id == $department->id ? 'selected' : '' }} value="{{$department->id}}" >{{$department->name}}</option>
                    @endforeach
                    
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category">Sub depart</label>
                    <select name="sub_department_id" id="sub_category" class="form-control">
                        <option selected value="{{$employee->sub_department_id}}" >{{$employee->subDepartment->name}}</option>
                        @foreach ($sub_departments_id as $sub_department_id)
                        <option {{ $employee->sub_department_id == $sub_department_id->id ? 'selected' : '' }} value="{{$sub_department_id->id}}" >{{$sub_department_id->name}}</option>
                        @endforeach
                    </select>
                    </select>
                </div>


                
                <div class="mb-3">
                    <label for=""  class="form-label">Position</label>
                    
                    <select
                        class="form-select form-select-lg"
                        name="position_id" id="category"
                    >

                    @foreach ($position as $position)
                    <option {{ $employee->position_id == $position->id ? 'selected' : '' }} value="{{$position->id}}" >{{$position->name}}</option>
                    @endforeach
                    
                    </select>
                </div>
                
                <div class="mb-3">
                    <input
                        type="submit"
                        class="form-control"
                        value="Create employees"               
                    />
                </div>

                <input type="file" name="image">
                {{-- <div class="col-12">
                    <div class="mb-3">
                        <label for="image">Image</label>
                        <div id="image" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">
                                <br>Drop files here or click to upload.<br><br>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row" id="product-gallery">

                </div> --}}
                <td><img src="{{ asset($employee->pic) }}" alt="Profile Picture" style="max-width: 100px; max-height: 100px;"></td>
            </form>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
     
      
    </body>
</html>
