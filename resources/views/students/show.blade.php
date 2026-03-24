@extends('students.layout')
@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100" style="max-width: 800px; padding: 2.5rem;">
        
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
            <h2 class="mb-0 fw-bold" style="color: #4b5563;">Student Profile</h2>
            <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('students.index') }}">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-4 text-center">
                @if($student->image)
                    <img src="{{ asset('assets/images/' . $student->image) }}" alt="Student Image" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover; object-position: center; border: 4px solid white;">
                @else
                    <div class="rounded-circle bg-light shadow d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px; font-size: 3rem; font-weight: bold; color: #cbd5e1; border: 4px solid white;">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                @endif
                <h3 class="mt-3 fw-bold text-dark">{{ $student->name }}</h3>
                <span class="badge bg-light text-primary border px-3 py-2 rounded-pill mt-1">{{ $student->course }}</span>
            </div>
            
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 bg-white bg-opacity-50 rounded-3 border h-100 shadow-sm">
                            <span class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Email Address</span>
                            <div class="fw-medium text-dark mt-1">{{ $student->email }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-white bg-opacity-50 rounded-3 border h-100 shadow-sm">
                            <span class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Phone Number</span>
                            <div class="fw-medium text-dark mt-1">{{ $student->phone }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-white bg-opacity-50 rounded-3 border h-100 shadow-sm">
                            <span class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Date of Birth</span>
                            <div class="fw-medium text-dark mt-1">{{ \Carbon\Carbon::parse($student->dob)->format('d M, Y') ?? $student->dob }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-white bg-opacity-50 rounded-3 border h-100 shadow-sm">
                            <span class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Grade</span>
                            <div class="fw-medium text-dark mt-1">{{ $student->grade }} / 100</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 bg-white bg-opacity-50 rounded-3 border h-100 shadow-sm">
                            <span class="text-uppercase text-muted" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">University</span>
                            <div class="fw-medium text-dark mt-1">
                                {{ $student->university ? $student->university->name : 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white bg-opacity-50 rounded-3 border p-4 shadow-sm">
            <span class="text-uppercase text-muted d-block mb-2" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">Student Details & Bio</span>
            <p class="text-dark mb-0" style="line-height: 1.6;">
                {{ $student->detail ?: 'No additional details provided for this student.' }}
            </p>
        </div>

    </div>
</div>
@endsection
