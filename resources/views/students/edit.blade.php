@extends('students.layout')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100" style="max-width: 850px; padding: 2.5rem;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold" style="color: var(--primary-color);">Edit Student</h2>
            <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('students.index') }}">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm mb-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                
                <!-- Full Width: Image with Preview -->
                <div class="col-12 mb-2">
                    <label class="form-label-modern"><i class="bi bi-person-bounding-box"></i> Student Profile Image</label>
                    <div class="d-flex flex-column flex-md-row align-items-center gap-4 p-4 bg-white bg-opacity-50 rounded-4 border border-white shadow-sm">
                        <img id="imagePreview" src="{{ $student->image ? asset('assets/images/' . $student->image) : '#' }}" alt="Current Image" class="rounded-circle shadow {{ $student->image ? '' : 'd-none' }}" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border: 4px solid white;">
                        <div class="flex-grow-1 w-100">
                            <input type="file" name="image" class="form-control-modern bg-white" id="imageInput" accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(this, 'imagePreview')">
                            <div class="form-text mt-2 text-muted" style="font-size: 0.85rem;">
                                <i class="bi bi-info-circle me-1"></i> Allowed: JPG, JPEG, PNG, GIF (Max 5MB). Image is auto-centered into a circle.
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Half Width: Name -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control-modern" placeholder="e.g. John Doe">
                </div>
                
                <!-- Half Width: Grade -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Grade</label>
                    <input type="number" name="grade" value="{{ old('grade', $student->grade) }}" class="form-control-modern" placeholder="e.g. 10">
                </div>
                
                <!-- Half Width: Email -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control-modern" placeholder="john@example.com">
                </div>
                
                <!-- Half Width: Phone -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', $student->phone) }}" class="form-control-modern" placeholder="+1 234 567 890">
                </div>
                
                <!-- Half Width: Course -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Course</label>
                    <input type="text" name="course" value="{{ old('course', $student->course) }}" class="form-control-modern" placeholder="e.g. Computer Science">
                </div>
                
                <!-- Half Width: DOB -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" class="form-control-modern">
                </div>
                
                <!-- Full Width: Detail -->
                <div class="col-12">
                    <label class="form-label-modern d-block">Student Details / Bio</label>
                    <textarea class="form-control-modern" style="height: 120px; resize: none;" name="detail" placeholder="Enter student background info...">{{ old('detail', $student->detail) }}</textarea>
                </div>
                
                <!-- Full Width: University -->
                <div class="col-12">
                    <label class="form-label-modern d-block">University Affiliation</label>
                    <select name="university_id" class="form-control-modern">
                        <option value="">Select University</option>
                        @foreach ($universities as $university)
                            <option value="{{ $university->id }}" {{ old('university_id', $student->university_id) == $university->id ? 'selected' : '' }}>
                                {{ $university->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Actions -->
                <div class="col-12 text-end mt-4 pt-3 border-top border-light">
                    <button type="submit" class="btn btn-modern px-5 py-2">Update Student</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.getElementById(previewId);
                img.src = e.target.result;
                img.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

