@extends('employee.layout.app')
@section('content')
<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #E0E2DB !important;
    border-radius: 10px !important;
    padding: 20px !important;
    background: #F8F7F7 !important;
    }
    .btn-con {
    position: absolute;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    display:none;
    place-items: center;
    transition: all .3s
    }
    .img-con:hover .btn-con{
        display: grid;
    }
    .img-con {
        margin: 10px 0px;
        /* display: flex; */
        position: relative;
    }
    .img-con button {
        background:#0000008a;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 8px;
    }
</style>
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
              
                            <div class="row">


                                <div class="form-group col-md-6">
                                    <label for="fname">First Name:</label>
                                    <input name="fname" type="text" class="form-control" id="fname"
                                        value="{{ $ticket->client->first_name }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">Last Name:</label>
                                    <input name="lname" type="text" class="form-control" id="lname"
                                        placeholder="Last Name" value="{{ $ticket->client->last_name }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="add1">Street Address 1:</label>
                                    <input name="street_address_1" type="text" class="form-control" id="add1"
                                        placeholder="Street Address 1" value="{{ $ticket->client->street_address_1 }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cname">Company Name:</label>
                                    <input name="company_name" type="text" class="form-control" id="cname"
                                        placeholder="Company Name" value="{{ $ticket->client->company_name }}">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Country:</label>
                                    <select name="country" class="selectpicker form-control" data-style="py-0">
                                        <option selected>{{ $ticket->client->country }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:</label>
                                    <input name="mobile_number" type="text" class="form-control" id="mobno"
                                        placeholder="Mobile Number" value="{{ $ticket->client->mobile_number }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                        placeholder="Email" value="{{ $ticket->client->email }}">
                                </div>
                            </div>
                            <div class="header-title mt-3">
                                <h4 class="card-title"> Ticket Information</h4>
                                <hr>
                            </div>
                            
                            <div class="row">

                            
                            <div class="form-group col-md-6">
                                <label for="subject">Subject</label>
                                <input name="subject" type="text" class="form-control" id="subject"
                                    placeholder="subject" value="{{ $ticket->subject }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description</label>
                                <input name="description" type="text" class="form-control" id="description"
                                    placeholder="description" value="{{ $ticket->description }}">
                            </div>





                            <div class="form-group col-sm-6">
                                <label>Department:</label>
                                <select id="category"  name="department_id" class="selectpicker form-control" data-style="py-0">
                                    <option selected value="{{ $ticket->department->name }}">{{ $ticket->department->name }}</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>Sub Department:</label>
                                <select name="sub_department_id" id="sub_category" class=" form-control" data-style="py-0">
                                    <option selected value="">{{ $ticket->subDepartment->name  ?? 'N/A'}}</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label>priority:</label>
                                <select name="priority"  class="selectpicker form-control"
                                    data-style="py-0">
                                    <option  selected value=""> {{ $ticket->priority }}</option>
                                </select>
                            </div>



                            <div class="form-group col-md-6">
                                <label for="price">Price:</label>
                                <input name="price" type="text" class="form-control" id="price"
                                    placeholder="price" value="{{ $ticket->price }}">
                            </div>

                            </div>
                                <div class="row" >
                                    @foreach ($attachments as $attachment)
        
                                    @php
                                        $extension = pathinfo($attachment->tempFile->source, PATHINFO_EXTENSION);
                                    @endphp
                                    @if (in_array($extension, ['png', 'jpeg', 'jpg', 'gif']))
                                        <div class="col-lg-4 col-md-6 img-con">
                                            <img src="{{ asset('temp/' . $attachment->tempFile->source) }}" alt="Attachment Image"
                                            style="max-width: 100%; max-height: 100%;">
                                            <div class="btn-con">
                                                <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                                                    <button>Download {{ strtoupper($extension) }} File</button>
                                                </a>
                                            </div>
                                        </div>
                                    @elseif(in_array($extension, ['docx', 'xls', 'xlsx', 'zip']))
                                        <div class=" col-lg-4 col-md-6 img-con ">
                                            <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                                                <button>Download {{ strtoupper($extension) }} File</button>
                                            </a>
                                        </div>
                                    @elseif($extension === 'pdf')
                                        <div class="col-lg-4 col-md-6 img-con">
                                            <embed src="{{ asset('temp/' . $attachment->tempFile->source) }}" type="application/pdf" width="200"
                                                height="200" />
                                                <div class="btn-con">
                                                    <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                                                        <button>Download {{ strtoupper($extension) }} File</button>
                                                    </a>
                                                </div>
                                        </div>
                                    @elseif($extension === 'zip')
                                    <div  class="col-lg-4 col-md-6 img-con">

                                        <a href="{{ asset('temp/' . $attachment->tempFile->source) }}" download>
                                            <button>Download ZIP File</button>
                                        </a>
                                    </div>
                                    @else
                                        <p>Unsupported file type: {{ $extension }}</p>
                                    @endif
                                    @endforeach
                                </div>
                         
                        </div>



                    <div class="col-12 mt-3">

                 
                </div>


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection 



