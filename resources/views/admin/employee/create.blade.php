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

            <form style="max-width:700px" class="border p-5" method="post"  action="{{ route('admin.Employee.store')}}" enctype="multipart/form-data" >
                @csrf

                <div class="mb-3">
                    <label for="" class="form-label">Employees Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"               
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Employees Email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"               
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Employees phone</label>
                    <input
                        type="text"
                        class="form-control"
                        name="phone"               
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Employees password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"               
                    />
                </div>
                <div class="mb-3">
                    <label for=""  class="form-label">Departments</label>
                    
                    <select
                        class="form-select form-select-lg"
                        name="department_id" id="category"
                    >
                    <option value="" selected>Select</option>
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}" >{{$department->name}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category">Sub depart</label>
                    <select name="sub_department_id" id="sub_category" class="form-control">
                        <option value="2">Please Select Sub depart</option>
                    </select>
                    </select>
                </div>
                <div class="mb-3">
                    <label for=""  class="form-label">Position</label>
                    
                    <select
                        class="form-select form-select-lg"
                        name="position_id" id="category"
                    >
                    <option value="" selected>Select</option>
                    @foreach ($Position as $Position)
                        <option value="{{$Position->id}}" >{{$Position->name}}</option>
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
                <div class="mb-3">
                    <label for=""  class="form-label">Select office shifts</label>
                    <select class="form-select form-select-lg" name="schedule_id">
                        <option value="" selected>Select</option>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->title }}</option>
                        @endforeach
                    </select>
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
                            $('#sub_category').append(
                                `<option value='${item.id}'>${item.name}</option>`)
                        })
                    }
                }
            })
        })
        function deleteImae(id) {
            $('#image-row-' + id).remove();
        }
        </script>
          <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
          <script>

    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        url: "{{ route('temp_file.create') }}",
        maxFiles: 20,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "application/pdf,image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            $("#image_id").val(response.image_id);
        },
        success: function(file, response) {
            if (response.ext == 'pdf') {

                let html = `
                    <div class="col-md-3 col-lg-3 col-md-4 col-sm-6  card img_div" id="image-row-${response.image_id}">
                        <div class="dropzoneimg p-2">
                            <embed src="${response.image_path}" class="card-img-top product_image" type="">
                            <input readonly type="text" hidden name="images_array[]" value="${response.image_id}">
                            <div class="card-body">
                                <a onclick="deleteImae(${response.image_id})"  class="img-delte-btn">Delete</a>
                            </div>
                        </div>
                    </div>
                `;
                $('#product-gallery').append(html)
            } else {
                let html = `
                        <div class="col-lg-3 col-md-4 col-sm-6  " id="image-row-${response.image_id}">
                            <div class="dropzoneimg p-2" >
                                <img src="${response.image_path}"  class="card-img-top product_image" alt="...">
                                <input readonly type="text" hidden name="images_array[]" value="${response.image_id}">
                                <div class="card-body">
                                    <a onclick="deleteImae(${response.image_id})" class="img-delte-btn">Delete</a>
                                </div>
                            </div>
                        </div>
                        `;
                $('#product-gallery').append(html)
            }



        },
        complete: function(file) {
            setTimeout(() => {
                this.removeFile(file)
            }, 10000);

        }
    })
          </script>
    </body>
</html>
