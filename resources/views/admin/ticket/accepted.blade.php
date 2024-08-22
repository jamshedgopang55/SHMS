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
                                <a href="{{ route('admin.ticket.index') }}" class="btn btn-primary">New Tickets</a>
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
                            <h4 class="card-title">Accepted Tickets</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped" style="text-transform: capitalize">
                                <thead>
                                    <tr class="ligth">

                                        <th scope="col">id</th>
                                        <th scope="col">employee name</th>
                                        <th scope="col">Client name</th>
                                       
                                        <th scope="col">Subject</th>
                                        <th scope="col">Department </th>
                                        <th scope="col">Sub Department </th>

                                        <th scope="col">priority</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>
                                <tbody >

                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{$ticket->employee->name }}</td>
                                            <td>{{ $ticket->client->first_name }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>{{ $ticket->department->name }}</td>
                                            <td>{{ $ticket->subDepartment->name ?? 'N/A'}}</td>

                                            <td>{{ $ticket->priority }}</td>

                                            <td>{{ $ticket->price }}</td>
                                            <td> <button class="btn btn-success" style="background: #158f15;border:none;text-transform:capitalize">{{ $ticket->status }}</button> </td>

                                            {{-- <td><img src="{{ asset($Eticketsmployee->pic) }}" alt="Profile Picture" style="max-width: 100px; max-height: 100px;"></td> --}}
                                            <td>
                                                <a href="{{ url('admin/ticket/show', $ticket->id) }}"
                                                    class="btn btn-primary">view</a>
                                                <form action="{{ route('admin.project.create') }}" method="POST">
                                                    @csrf
                                                    <input type="number" hidden name="id" value="{{ $ticket->id }}"
                                                        hidden id="">
                                                    @php
                                                    $hasProjects = App\Models\Project::where('ticket_id', $ticket->id)->exists();
                                                   @endphp
                                                    
                                                    
                                                        @if (!$hasProjects)
                                                    <input type="submit" value="create project">
                                                    @else
                                                    @endif
                                                    {{-- <a  href="{{ route('admin.project.create') }}" class="btn btn-warning">create Project</a> --}}
                                                </form>

                                                {{-- <form action="{{ route('admin.project.create') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                    @php
                                                        $hasProjects = App\Models\Project::where('ticket_id', $ticket->id)->exists();
                                                    @endphp
                                                    @if (!$hasProjects)
                                                        <button type="submit" class="btn btn-primary">Create Project</button>
                                                    @else
                                                        <button type="button" class="btn btn-secondary" disabled>Project Already Created</button>
                                                    @endif
                                                </form> --}}

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
