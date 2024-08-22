@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>milestone</h5>
                        <div class="d-flex align-items-center">
                            {{-- @can('create workFromHomePermission') --}}
                            <div class="pl-3 border-left btn-new">
                                <a href="{{ route('admin.milestone.create', $id) }}" class="btn btn-primary">Create MileStone
                                </a>
                            </div>
                            {{-- @endcan --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                            <thead>
                                <tr class="ligth">
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                  
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->due_date }}</td>
                                        <td>{{ $item->price }}</td>
                                       
                                        <td>
                                            {{-- <a href="{{ route('admin.data.show', $item->id) }}" class="btn btn-info">View</a> --}}
                                            <a href="{{ route('admin.milestone.edit', $item->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin.milestone.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
