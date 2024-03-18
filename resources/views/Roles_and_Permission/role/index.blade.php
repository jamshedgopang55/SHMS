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
        @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
         @endif
   

        <div
            class="table-responsive"
        >
            <h1 class="mt-5">Roles</h1>
            <div class="m-3" style="text-align:right">
                <a href="{{route('admin.roles.create')}}"  class="btn text btn-primary">Create New Role</a>
            </div>
            <table
                class="table table-primary"
            >
                <thead>
                    <tr>
                        <th scope="col">Role_id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Roles as $role)
                    
                    <tr class="">
                        <td scope="row">{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                      
                        <td>
                           
                            <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-warning">
                                Edit
                            </a>
                            <a href="{{ url('admin/roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">
                                Add / Edit Role Permission
                            </a>
                            
                          
                            <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
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
