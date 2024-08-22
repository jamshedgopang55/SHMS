@extends('employee.layout.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create User Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form method="POST" action="{{route('employee.client.store')}}">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input required name="fname" type="text" class="form-control" id="name"
                                        placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input required name="lname" type="text" class="form-control" id="lname"
                                        placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="add1">Street Address 1:</label>
                                    <input name="street_address_1" type="text" class="form-control" id="add1"
                                        placeholder="Street Address 1">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cname">Company Name:</label>
                                    <input required name="company_name" type="text" class="form-control" id="cname"
                                        placeholder="Company Name">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Country:</label>
                                    <select required name="country" class="selectpicker form-control" data-style="py-0">
                                        <option readonly >Select Country</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="India">India</option>
                                        <option value="USA">USA</option>
                                        <option value="Uk">Uk</option>
                                        <option value="Dubai">Dubai</option>
                                        <option value="Africa">Africa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input required name="mobile_number" type="text" class="form-control" id="mobno"
                                        placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input required name="email" type="email" class="form-control" id="email"
                                        placeholder="Email">
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
