@extends('auth.layouts')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">

<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100 p-5">
        
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-4" style="border-color: var(--glass-border) !important;">
            <div>
                <h2 class="mb-1 fw-bold" style="color: var(--primary-color);">System Dashboard</h2>
                <p class="text-muted mb-0">Overview of your platform's statistics and data.</p>
            </div>
            <div>
                <button class="btn btn-modern" onclick="window.location.reload();">
                    <i class="bi bi-arrow-clockwise me-2"></i> Refresh Data
                </button>
            </div>
        </div>

        <!-- Metrics Cards Row -->
        <div class="row g-4 justify-content-center mb-4">
            
            <!-- Total Students -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-4 p-4 h-100 d-flex flex-column justify-content-between border shadow-sm" style="transition: transform 0.2s, box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.02)';">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="text-muted fw-semibold text-uppercase mb-0 mt-1" style="font-size: 0.85rem; letter-spacing: 0.5px;">Total Students</h6>
                        <div class="p-2 rounded-3" style="background-color: rgba(99, 102, 241, 0.1);">
                            <i class="bi bi-people" style="font-size: 1.5rem; color: var(--primary-color);"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">{{ str_pad($studentCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            <!-- Total News -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-4 p-4 h-100 d-flex flex-column justify-content-between border shadow-sm" style="transition: transform 0.2s, box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.02)';">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="text-muted fw-semibold text-uppercase mb-0 mt-1" style="font-size: 0.85rem; letter-spacing: 0.5px;">Total News</h6>
                        <div class="p-2 rounded-3" style="background-color: rgba(245, 158, 11, 0.1);">
                            <i class="bi bi-newspaper" style="font-size: 1.5rem; color: #f59e0b;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">{{ str_pad($totalNewsCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            <!-- Active News -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-4 p-4 h-100 d-flex flex-column justify-content-between border shadow-sm" style="transition: transform 0.2s, box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.02)';">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="text-muted fw-semibold text-uppercase mb-0 mt-1" style="font-size: 0.85rem; letter-spacing: 0.5px;">Active News</h6>
                        <div class="p-2 rounded-3" style="background-color: rgba(16, 185, 129, 0.1);">
                            <i class="bi bi-check-circle" style="font-size: 1.5rem; color: #10b981;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">{{ str_pad($activeNewsCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            <!-- Inactive News -->
            <div class="col-lg-3 col-md-6">
                <div class="bg-white rounded-4 p-4 h-100 d-flex flex-column justify-content-between border shadow-sm" style="transition: transform 0.2s, box-shadow 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.02)';">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="text-muted fw-semibold text-uppercase mb-0 mt-1" style="font-size: 0.85rem; letter-spacing: 0.5px;">Inactive News</h6>
                        <div class="p-2 rounded-3" style="background-color: rgba(239, 68, 68, 0.1);">
                            <i class="bi bi-x-circle" style="font-size: 1.5rem; color: #ef4444;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-0" style="font-size: 2.2rem;">{{ str_pad($inactiveNewsCount, 2, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection
