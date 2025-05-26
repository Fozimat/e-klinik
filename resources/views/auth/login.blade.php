@extends('layouts.master-without-nav')

@section('title')
    Login
@endsection

@section('content')
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Selamat Datang!</h5>
                            <p class="text-muted">Login untuk melanjutkan.</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" id="email"
                                        placeholder="Enter Email address">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="userpassword" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light"
                                        type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
