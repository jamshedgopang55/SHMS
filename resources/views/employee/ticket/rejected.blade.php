<!doctype html>
<html lang="en">
<head>
    <title>Employee</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="text-center">
    <div class="container">
        <h1 class="mt-5">Employee</h1>
       
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        {{-- <th scope="col">Employer ID</th> --}}
                       
                        <th scope="col">id</th>
                        <th scope="col">Client name</th>
                        <th scope="col">Client phone</th>
                        <th scope="col">Client email</th>
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
                        <td>{{ $ticket->client_name }}</td>
                        <td>{{ $ticket->client_phone }}</td>
                        <td>{{ $ticket->client_email }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->department->name }}</td>
                        <td>{{ $ticket->subDepartment->name }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->priority }}</td>
                       
                        <td>{{ $ticket->price }}</td>
                        <td>{{ $ticket->status }}</td>
                        
                        {{-- <td><img src="{{ asset($Eticketsmployee->pic) }}" alt="Profile Picture" style="max-width: 100px; max-height: 100px;"></td> --}}
                        <td>
                            <a  href="{{ url('admin/ticket/show', $ticket->id) }}" class="btn btn-warning">view</a>
                            {{-- <a href="{{ url('Employee/destory', $Employee->id) }}" class="btn btn-danger">Delete</a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
