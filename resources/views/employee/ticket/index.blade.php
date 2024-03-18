


@extends('employee.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Tickets</h5>
                        <div class="d-flex align-items-center">
                            <div class="list-grid-toggle d-flex align-items-center mr-3">
                                <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                    <div class="grid-icon mr-3">
                                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="14" width="7" height="7"></rect>
                                            <rect x="3" y="14" width="7" height="7"></rect>
                                        </svg>
                                    </div>
                                </div>
                                <div data-toggle-extra="tab" data-target-extra="#list">
                                    <div class="grid-icon">
                                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="21" y1="10" x2="3" y2="10"></line>
                                            <line x1="21" y1="6" x2="3" y2="6"></line>
                                            <line x1="21" y1="14" x2="3" y2="14"></line>
                                            <line x1="21" y1="18" x2="3" y2="18"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
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
    <div class="container-fluid">
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
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th scope="col">id</th>
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
                                            <td>{{ $ticket->client->first_name }} {{ $ticket->client->last_name }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>{{ $ticket->department->name }}</td>
                                            <td>{{ $ticket->subDepartment->name }}</td>
                                            <td>{{ $ticket->description }}</td>
                                            <td>{{ $ticket->priority }}</td>
                                            <td>{{ $ticket->price }}</td>
                                            <td>{{ $ticket->status }}</td>
                                            <td>
                                                <a href="{{ route('employee.ticket.show', $ticket->id) }}">View</a>
                                                {{-- <a href="{{ url('Employee/destory', $Employee->id) }}" class="btn btn-danger">Delete</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                        
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="col">id</th>
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
    </div>
@endsection


