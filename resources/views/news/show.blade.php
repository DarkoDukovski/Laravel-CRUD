@extends('students.layout')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100 overflow-hidden" style="max-width: 800px; padding: 0;">
        
        <!-- Header Image Area -->
        <div class="position-relative bg-light" style="height: 300px;">
            @if($news->image)
                <img src="{{ asset('assets/images/' . $news->image) }}" alt="News Image" class="w-100 h-100" style="object-fit: cover; object-position: center;">
            @else
                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted" style="background: rgba(0,0,0,0.05);">
                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                </div>
            @endif
            
            <div class="position-absolute top-0 end-0 p-4">
                @if($news->status == 1)
                    <span class="badge bg-success shadow fs-6 px-3 py-2 rounded-pill">Active</span>
                @else
                    <span class="badge bg-secondary shadow fs-6 px-3 py-2 rounded-pill">Inactive</span>
                @endif
            </div>
            
            <div class="position-absolute top-0 start-0 p-4">
                <a class="btn btn-light shadow-sm rounded-circle d-flex align-items-center justify-content-center" href="{{ route('news.index') }}" style="width: 40px; height: 40px;">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-5">
            <h1 class="fw-bold text-dark mb-4" style="line-height: 1.3;">{{ $news->title }}</h1>
            
            <div class="bg-white bg-opacity-50 rounded-3 border p-4 shadow-sm">
                <p class="text-dark mb-0" style="font-size: 1.1rem; line-height: 1.8; white-space: pre-line;">
                    {{ $news->description }}
                </p>
            </div>
            
            @auth
            <div class="mt-5 text-end">
                <a class="btn btn-modern px-4" href="{{ route('news.edit', $news->id) }}">
                    <i class="bi bi-pencil-square me-2"></i> Edit Article
                </a>
            </div>
            @endauth
        </div>
        
    </div>
</div>
@endsection

