@extends('students.layout')

@section('content')
<div class="container mt-5">
    <div class="glass-container w-100 p-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold" style="color: var(--primary-color);">Students Directory</h2>
            <a class="btn btn-modern px-4 py-2" href="{{ route('students.create') }}">
                <i class="bi bi-plus-lg"></i> Add Student
            </a>
        </div>
       
        @if ($message = Session::get('success'))
            <div class="alert alert-success rounded-3 shadow-sm mb-4">
                <p class="mb-0">{{ $message }}</p>
            </div>
        @endif
       
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="border-collapse: separate; border-spacing: 0 8px;">
                <thead style="background: rgba(99, 102, 241, 0.05);">
                    <tr>
                        <th class="border-0 rounded-start px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Image</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Name</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Grade</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Email</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Phone</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Course</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">Date of Birth</th>
                        <th class="border-0 px-3 py-3 text-secondary text-uppercase" style="font-size: 0.85rem; font-weight: 600;">University</th>
                        <th class="border-0 rounded-end px-3 py-3 text-secondary text-uppercase text-center" style="font-size: 0.85rem; font-weight: 600; min-width: 220px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr style="background: rgba(255, 255, 255, 0.5); border-radius: 10px; transition: all 0.2s ease;">
                        <td class="px-3 py-3 rounded-start">
                            @if($student->image)
                                <img src="{{ asset('assets/images/' . $student->image) }}" alt="{{ $student->name }}" class="rounded-circle shadow-sm" style="width: 45px; height: 45px; object-fit: cover; object-position: center;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-secondary shadow-sm" style="width: 45px; height: 45px; font-weight: 600;">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-3 py-3 fw-medium text-dark">{{ $student->name }}</td>
                        <td class="px-3 py-3 text-muted">{{ $student->grade }}</td>
                        <td class="px-3 py-3 text-muted">{{ $student->email }}</td>
                        <td class="px-3 py-3 text-muted">{{ $student->phone }}</td>
                        <td class="px-3 py-3 text-muted"><span class="badge bg-light text-dark border">{{ $student->course }}</span></td>
                        <td class="px-3 py-3 text-muted">{{ $student->dob }}</td>
                        <td class="px-3 py-3 text-muted">
                            @isset($student->university->name)
                                {{ $student->university->name }}
                            @else
                                <span class="text-secondary fst-italic">None</span>
                            @endisset 
                        </td>
                        <td class="px-3 py-3 rounded-end text-center">
                            <form action="{{ route('students.destroy',$student->id) }}" method="POST" class="d-inline">
                                <a class="btn btn-sm btn-outline-info rounded-pill px-3" href="{{ route('students.show',$student->id) }}">Show</a>
                                <a class="btn btn-sm btn-outline-primary rounded-pill px-3 mx-1" href="{{ route('students.edit',$student->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

