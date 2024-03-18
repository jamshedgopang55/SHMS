<section class=" section-10">
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
        <div class="login-form">
            <form action="{{ route('user.authenticate') }}" method="post">
                @csrf
                <h4 class="modal-title">Login to Your Account</h4>
                <div class="form-group">
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email"
                        value="{{ old('email') }}">
                    @error('email')
                       <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror

                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Password">
                    @error('password')
                       <p class="invalid-feedback"> {{ $message }}</p>
                    @enderror
                </div>
               
                <input type="submit" class="btn btn-dark btn-block btn-lg" value="Login">
            </form>
            </div>
        </div>
    </div>
</section>