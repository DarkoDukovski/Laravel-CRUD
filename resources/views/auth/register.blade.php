@extends('auth.layouts')

@section('content')

<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100" style="max-width: 550px; padding: 2.5rem;">
        
        <div class="text-center mb-4">
            <h2 class="mb-0 fw-bold" style="color: var(--primary-color);">Register</h2>
            <p class="text-muted mt-2">Create a new account to get started.</p>
        </div>

        <form action="{{ route('store') }}" method="post">
            @csrf
            
            <div class="row g-4">
                <div class="col-12">
                    <label for="name" class="form-label-modern d-block">Name</label>
                    <input type="text" class="form-control-modern @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name">
                    @if ($errors->has('name'))
                        <span class="text-danger mt-1 d-block" style="font-size: 0.875rem;">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="col-12">
                    <label for="email" class="form-label-modern d-block">Email Address</label>
                    <input type="email" class="form-control-modern @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @if ($errors->has('email'))
                        <span class="text-danger mt-1 d-block" style="font-size: 0.875rem;">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="col-12">
                    <label for="password" class="form-label-modern d-block">Password</label>
                    <input type="password" class="form-control-modern @error('password') is-invalid @enderror" id="password" name="password" placeholder="Create a strong password">
                    @if ($errors->has('password'))
                        <span class="text-danger mt-1 d-block" style="font-size: 0.875rem;">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="col-12">
                    <label for="password_confirmation" class="form-label-modern d-block">Confirm Password</label>
                    <input type="password" class="form-control-modern" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
                </div>

                <div class="col-12 mt-4 text-center">
                    <button type="submit" class="btn btn-modern w-100 py-2">Register</button>
                    <div class="mt-3">
                        <span class="text-muted">Already have an account? <a href="{{ route('login') }}" style="color: var(--primary-color); font-weight: 500; text-decoration: none;">Login here</a></span>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
    
@endsection