@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Tickets</h5>
                        <div class="d-flex align-items-center">
                          
                            <div class="pl-3 border-left btn-new">
                                <a href="{{route('admin.ticket.accepted')}}" class="btn btn-primary" 
                                >Accepted Tickets</a>
                            </div>
                            <div class="pl-3 border-left btn-new">
                                <a href="{{route('admin.ticket.rejected')}}" class="btn btn-primary" 
                                >Rejected Tickets</a>
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
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">New Tickets </h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped"  style="text-transform: capitalize">
                                <thead>
                                    <tr class="ligth">
                                        <th scope="col">id</th>
                                        <th scope="col">employee name</th>
                                        <th scope="col">Client name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Department </th>
                                        <th scope="col">Sub Department </th>
                                        <th scope="col">Description</th>
                                        <th scope="col">priority</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{$ticket->employee->name }}</td>
                                            <td>{{ $ticket->client->first_name }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>{{ $ticket->department->name }}</td>
                                            <td>{{ $ticket->subDepartment->name ?? 'N/A' }}</td>

                                            <td>{{ $ticket->description }}</td>
                                            <td>{{ $ticket->priority }}</td>

                                            <td>{{ $ticket->price }}</td>
                                            <td>{{ $ticket->status }}</td>
                                            <td>
                                                <a href="{{ url('admin/ticket/show', $ticket->id) }}"
                                                    class="btn btn-primary">view</a>
                                                {{-- <a href="{{ url('Employee/destory', $Employee->id) }}" class="btn btn-danger">Delete</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">employee name</th>
                                        <th scope="col">Client name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Department </th>
                                        <th scope="col">Sub Department </th>
                                        <th scope="col">Description</th>
                                        <th scope="col">priority</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
                    // enctype: 'multipart/form-data',
                    type: 'POST',
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
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
