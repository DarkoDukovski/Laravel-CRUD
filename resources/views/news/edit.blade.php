@extends('students.layout')
@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="glass-container w-100" style="max-width: 700px; padding: 2.5rem;">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold" style="color: var(--primary-color);">Edit News</h2>
            <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('news.index') }}">
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
        
        <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                
                <!-- Full Width: Title -->
                <div class="col-12">
                    <label class="form-label-modern d-block">News Title</label>
                    <input type="text" name="title" value="{{ $news->title }}" class="form-control-modern" placeholder="Enter headline...">
                </div>
                
                <!-- Full Width: Description -->
                <div class="col-12">
                    <label class="form-label-modern d-block">Description</label>
                    <textarea name="description" class="form-control-modern" style="height: 120px; resize: none;" placeholder="Write your news content here...">{{ $news->description }}</textarea>
                </div>
                
                <!-- Half Width: Status -->
                <div class="col-md-6">
                    <label class="form-label-modern d-block">Status</label>
                    <select name="status" class="form-control-modern">
                        <option value="">--Select Status--</option>
                        <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <!-- Full Width: Image with preview -->
                <div class="col-12 mt-4">
                    <label class="form-label-modern"><i class="bi bi-image"></i> Update Cover Image</label>
                    <div class="d-flex flex-column flex-md-row align-items-center gap-4 p-4 bg-white bg-opacity-50 rounded-4 border border-white shadow-sm">
                        <img id="imagePreview" src="{{ $news->image ? asset('assets/images/' . $news->image) : '#' }}" alt="Current Image" class="rounded-3 shadow {{ $news->image ? '' : 'd-none' }}" style="height: 100px; width: 160px; object-fit: cover; object-position: center; border: 3px solid white;">
                        <div class="flex-grow-1 w-100">
                            <input type="file" name="image" class="form-control-modern bg-white" accept="image/*" onchange="previewImage(this, 'imagePreview')">
                            <div class="form-text mt-2 text-muted" style="font-size: 0.85rem;">
                                <i class="bi bi-info-circle me-1"></i> Allowed: JPG, JPEG, PNG, GIF (Max 5MB). Images are auto-centered.
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="col-12 text-end mt-4 pt-3 border-top border-light">
                    <button type="submit" class="btn btn-modern px-5 py-2">Update News</button>
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
