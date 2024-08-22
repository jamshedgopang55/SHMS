@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Personal Information</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="profileForm">
                                    <div class="form-group row align-items-center">
                                        <div class="col-md-12">
                                            <div class="profile-img-edit">
                                                <div class="crm-profile-img-edit">
                                                    <img class="crm-profile-pic rounded-circle avatar-100"
                                                        src="{{ asset(Auth::user()->pic) }}" alt="profile-pic">
                                                    <div class="crm-p-image bg-primary">
                                                        <label for="imageInput" class="las la-pen upload-button"></label>
                                                        <input id="imageInput" class="file-upload" type="file" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="email">Email:</label>
                                            <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="cpass">Current Password:</label>
                                            <a href="javascript:void(0);" class="float-right">Forgot Password</a>
                                            <input type="password" class="form-control" id="cpass" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="npass">New Password:</label>
                                            <input type="password" class="form-control" id="npass" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass">Verify Password:</label>
                                            <input type="password" class="form-control" id="vpass" value="">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
<script>
    $(document).ready(function () {
        $('#profileForm').submit(function (event) {
            event.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var currentPassword = $('#cpass').val();
            var newPassword = $('#npass').val();
            var verifyPassword = $('#vpass').val();
            var image = $('#imageInput').prop('files')[0];

            var formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('current_password', currentPassword);
            formData.append('new_password', newPassword);
            formData.append('verify_password', verifyPassword);
            formData.append('image', image);

            $.ajax({
                url: '{{ route("admin.profile.update") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                     location.reload();
                    // Handle success response
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                    // Handle error response
                }
            });
        });
    });
</script>
@endsection
