<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body class="text-center">
   

        <div
            class="table-responsive"
        >
            <h1 class="mt-5">Departments</h1>
            <div class="m-3" style="text-align:right">
                <a href="{{route('admin.subdepartment.create')}}"  class="btn text btn-primary">Create New department</a>
            </div>
            <table
                class="table table-primary"
            >
                <thead>
                    <tr>
                        <th scope="col">Sub department_id</th>
                        <th scope="col">Sub Department Name</th>
                        <th scope="col">Department Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $subdepartment)
                    
                    <tr class="">
                        <td scope="row">{{ $subdepartment->id }}</td>
                        <td>{{ $subdepartment->name }}</td>
                        <td>{{ optional($subdepartment->department)->name ?? 'N/A' }}</td>
                        <!-- Display department name -->
                        <td>
                            <a href="{{ route('admin.subdepartment.edit', ['id'=> $subdepartment->id]) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <form action="{{route('admin.subdepartment.destroy')}}" method="POST">
                                <input hidden type="text" name="id" value="{{$subdepartment->id}}">
                                <input type="submit" value="delete">
                            </form>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
        


        

       


        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
