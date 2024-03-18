@extends('employee.layout.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title"> User Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="POST" action="{{ route('employee.ticket.store') }}">
                            <input type="number" name="employee_id" hidden
                                value="{{ Auth::guard('employee')->user()->id }}" id="">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="fname">Select Clint</label>
                                    <select class="clients w-100" name="client_id" id="clients">
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input name="fname" type="text" class="form-control" id="fname"
                                        placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input name="lname" type="text" class="form-control" id="lname"
                                        placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="add1">Street Address 1:</label>
                                    <input name="street_address_1" type="text" class="form-control" id="add1"
                                        placeholder="Street Address 1">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cname">Company Name:</label>
                                    <input name="company_name" type="text" class="form-control" id="cname"
                                        placeholder="Company Name">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Country:</label>
                                    <select name="country" class="selectpicker form-control" data-style="py-0">
                                        <option>Select Country</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="India">India</option>
                                        <option value="USA">USA</option>
                                        <option value="Uk">Uk</option>
                                        <option value="Africa">Africa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input name="mobile_number" type="text" class="form-control" id="mobno"
                                        placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="header-title">
                                <h4 class="card-title"> Ticket Information</h4>
                            </div>
                            <div class="row">

                            </div>
                            <div class="form-group col-md-12">
                                <label for="subject">Subject</label>
                                <input name="subject" type="text" class="form-control" id="subject"
                                    placeholder="subject">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <input name="description" type="text" class="form-control" id="description"
                                    placeholder="description">
                            </div>





                            <div class="form-group col-sm-12">
                                <label>Department:</label>
                                <select id="category"  name="department_id" class="selectpicker form-control" data-style="py-0">
                                    <option value="" selected>Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-12">
                                <label>Sub Department:</label>
                                <select name="sub_department_id" id="sub_category" class=" form-control" data-style="py-0">
                                    <option value="">Please Select Sub depart</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>priority:</label>
                                <select name="priority"  class="selectpicker form-control"
                                    data-style="py-0">
                                    <option  selected value="">Please Select priority</option>
                                    <option value="high">high</option>
                                    <option value="medium">medium</option>
                                    <option value="less">less</option>
                                </select>
                            </div>



                            <div class="form-group col-md-6">
                                <label for="price">Price:</label>
                                <input name="price" type="text" class="form-control" id="price"
                                    placeholder="price">
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="images">Files</label>
                                    <input type="file" name="images[]" id="images"
                                        accept="image/*,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.zip"
                                        multiple>
                                </div>
                            </div>
                            <div class="row" id="product-gallery">
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add New User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('customJs')
    <script>
        $(document).ready(function() {
            $('#clients').select2({
                ajax: {
                    url: '{{ route('employee.client.search') }}',
                    dataType: 'json',
                    tags: true,
                    // multiple: true,
                    minimumInputLength: 3,
                    processResults: function(data) {
                        return {
                            results: data.tags
                        };
                    }
                }
            });

            $('#clients').on('select2:select', function(e) {
                var selectedOption = $(e.currentTarget).find("option:selected");
                var clientId = selectedOption.val();
                // Fetch client record using AJAX
                $.ajax({
                    url: '{{ route('employee.client.fetch') }}',
                    type: 'GET',
                    data: {
                        clientId: clientId
                    },
                    success: function(response) {
                        // Populate input fields with fetched data
                        $('#fname').val(response.first_name);
                        $('#lname').val(response.last_name);
                        $('#add1').val(response.street_address_1);
                        $('#cname').val(response.company_name);
                        $('#mobno').val(response.mobile_number);
                        $('#email').val(response.email);
                        // Auto-fill client's country
                        $('[name="country"]').val(response.country).trigger('change');
                        
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
        $('#category').change(function() {
            let category_id = $(this).val()
            $.ajax({
                url: "{{ route('get/sub/department') }}",
                type: 'GET',
                data: {
                    category_id: category_id
                },
                success: function(response) {
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
        // });
        const uploadField = document.getElementById("images");

        uploadField.onchange = function() {
            if (this.files[0].size > 20971520) {
                alert("File is too big! Please upload a file that is less than or equal to 20MB.");
                this.value = "";
            }
        }

        function deleteImae(id) {
            $('#image-row-' + id).remove();
        }
        $('#images').change(function() {
            var formData = new FormData();
            var files = $(this)[0].files;

            // Append each file to the FormData object
            for (var i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            $.ajax({
                url: '{{ route('temp_file.create') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#image_id").val(response.image_id);
                },
                success: function(response) {
                    // Handle success response

                    console.log(response);
                    response.images.forEach(element => {
                        if (element.ext == 'pdf') {

                            let html = `
                        <div class="col-md-3 col-lg-3 col-md-4 col-sm-6  card img_div" id="image-row-${element.image_id}">
                        <div class="dropzoneimg p-2">
                        <embed src="${element.image_path}" class="card-img-top product_image" type="">
                        <input readonly type="text" hidden name="images_array[]" value="${element.image_id}">
                        <div class="card-body">
                        <a onclick="deleteImae(${element.image_id})"  class="img-delte-btn">Delete</a>
                        </div>
                        </div>
                        </div>
                        `;
                            $('#product-gallery').append(html)
                        } else if (response.ext == 'zip') {
                            let html = `
                        <div class="col-lg-3 col-md-4 col-sm-6  " id="image-row-${response.image_id}">
                            <div class="dropzoneimg p-2" >
                                <img src="data:image/png;base64,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"  class="card-img-top product_image" alt="...">
                                <input readonly type="text" hidden name="images_array[]" value="${response.image_id}">
                                <div class="card-body">
                                    <a onclick="deleteImae(${response.image_id})" class="img-delte-btn">Delete</a>
                                </div>
                            </div>
                        </div>
                        `;
                            $('#product-gallery').append(html)
                        } else if (response.ext == 'docx') {
                            let html = `
                            <div class="col-lg-3 col-md-4 col-sm-6" id="image-row-${response.image_id}">
                                <div class="dropzoneimg p-2">
                                    <a href="${response.image_path}" download>Download Word File</a>
                                    <input readonly type="text" hidden name="images_array[]" value="${response.image_id}">
                                    <div class="card-body">
                                        <a onclick="deleteImae(${response.image_id})" class="img-delte-btn">Delete</a>
                                    </div>
                                </div>
                            </div>
                        `;
                            $('#product-gallery').append(html);
                        } else if (['png', 'jpeg', 'jpg', 'gif'].includes(element.ext
                                .toLowerCase())) {
                            let html = `
        <div class="col-lg-3 col-md-4 col-sm-6  " id="image-row-${element.image_id}">
            <div class="dropzoneimg p-2" >
                <img src="${element.image_path}"  class="card-img-top product_image" alt="...">
                <input readonly type="text" hidden name="images_array[]" value="${element.image_id}">
                <div class="card-body">
                    <a onclick="deleteImae(${element.image_id})" class="img-delte-btn">Delete</a>
                </div>
            </div>
        </div>
    `;
                            $('#product-gallery').append(html);
                        }
                    });

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

    </script>
@endsection
