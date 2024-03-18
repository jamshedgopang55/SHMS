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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
         <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  
    </head>

    <body style="display: grid;place-items:center;">
        

        <div>
            <h1 class="my-4">user Edit</h1>

            <form style="max-width:700px" class="border p-5" method="post"  action="{{ route('admin.user.update')}}" enctype="multipart/form-data" >
                @csrf
                <input type="text" name="id" value="{{$user->id}}" id="">
                <div class="mb-3">
                    <label for="" class="form-label">User Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        value="{{$user->name}}"             
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">User Email</label>
                    <input
                        type="Email"
                        class="form-control"
                        name="email"            
                        value="{{$user->email}}"        
                    />
                </div>
             
                
              
                <div class="mb-3">
                    <label for="" class="form-label">User phone</label>
                    <input
                        type="phone"
                        class="form-control"
                        name="phone"        
                        value="{{$user->phone}}"            
                    />
                </div>


                <div  class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="name">
                </div>

               
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="">Roles</label>
                        <select name="roles[]" class="form-control" multiple>
                            @foreach ($roles as $role)
                            <option
                                value="{{ $role }}"
                                {{ in_array($role, $userRoles) ? 'selected':'' }}
                            >
                                {{ $role }}
                            </option>
                            @endforeach
                        </select>
                        @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
               
               


                <img src="{{ asset($user->pic) }}" alt="Profile Picture" style="max-width: 100px; max-height: 100px;">
                <input type="file" name="image">

                <div class="mb-3">
                    <input
                        type="submit"
                        class="form-control"
                        value="update user"               
                    />
                </div>

               
                

            </form>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Bootstrap JavaScript Libraries -->

    </body>
</html>
