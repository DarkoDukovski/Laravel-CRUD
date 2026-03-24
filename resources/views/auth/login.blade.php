@extends('auth.layouts')

@section('content')

<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100" style="max-width: 500px; padding: 2.5rem;">
        
        <div class="text-center mb-4">
            <h2 class="mb-0 fw-bold" style="color: var(--primary-color);">Login</h2>
            <p class="text-muted mt-2">Welcome back! Please enter your details.</p>
        </div>

        <form action="{{ route('authenticate') }}" method="post">
            @csrf
            
            <div class="row g-4">
                <div class="col-12">
                    <label for="email" class="form-label-modern d-block">Email Address</label>
                    <input type="email" class="form-control-modern @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                    @if ($errors->has('email'))
                        <span class="text-danger mt-1 d-block" style="font-size: 0.875rem;">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="col-12">
                    <label for="password" class="form-label-modern d-block">Password</label>
                    <input type="password" class="form-control-modern @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password">
                    @if ($errors->has('password'))
                        <span class="text-danger mt-1 d-block" style="font-size: 0.875rem;">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="col-12 mt-4 text-center">
                    <button type="submit" class="btn btn-modern w-100 py-2">Login</button>
                    <div class="mt-3">
                        <span class="text-muted">Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-color); font-weight: 500; text-decoration: none;">Register here</a></span>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
    
@endsection