@extends('auth')

@section('auth-content')
    <div class="card-body">

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">{{ __('Login') }}</h5>
            <p class="text-center small">Enter your username & password to login</p>
        </div>

        <form class="row g-3 needs-validation" action="{{ route('login') }}" novalidate method="post">
            @csrf
            <div class="col-12">
                <label for="yourUsername" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    <div class="invalid-feedback">Please enter your username.</div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                <div class="invalid-feedback">Please enter your password!</div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </div>
            <div class="col-12">
                <p class="small mb-0">Don't have account? <a href="{{ route('register') }}">Create an account</a>
                </p>
            </div>
        </form>

    </div>
@endsection
