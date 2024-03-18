@extends('employee.layout.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit User Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="edit-user-info">
                        <form method="POST" action="{{route('employee.client.update')}}">
                            @csrf
                            <input type="text" name="id" hidden value="{{$client->id}}" id="">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input name="fname" type="text" class="form-control" id="fname"
                                        placeholder="First Name" value="{{ $client->first_name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input name="lname" type="text" class="form-control" id="lname"
                                        placeholder="Last Name" value="{{ $client->last_name }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="add1">Street Address 1:</label>
                                    <input name="street_address_1" type="text" class="form-control" id="add1"
                                        placeholder="Street Address 1" value="{{ $client->street_address_1 }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cname">Company Name:</label>
                                    <input name="company_name" type="text" class="form-control" id="cname"
                                        placeholder="Company Name" value="{{ $client->company_name }}">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Country:</label>
                                    <select name="country" class="selectpicker form-control" data-style="py-0">
                                        <option>Select Country</option>
                                        <option value="Pakistan" {{ $client->country == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="India" {{ $client->country == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="USA" {{ $client->country == 'USA' ? 'selected' : '' }}>USA</option>
                                        <option value="Uk" {{ $client->country == 'Uk' ? 'selected' : '' }}>Uk</option>
                                        <option value="Africa" {{ $client->country == 'Africa' ? 'selected' : '' }}>Africa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input name="mobile_number" type="text" class="form-control" id="mobno"
                                        placeholder="Mobile Number" value="{{ $client->mobile_number }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                        placeholder="Email" value="{{ $client->email }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
