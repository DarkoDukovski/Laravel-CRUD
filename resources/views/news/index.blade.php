@extends('students.layout')

@section('content')
<div class="container mt-5">
    <div class="glass-container w-100 p-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2 class="mb-0 fw-bold" style="color: var(--primary-color);">News Updates</h2>
            
            <div class="d-flex gap-3 align-items-center">
                <div style="min-width: 150px;">
                    <select id="statusFilter" class="form-control-modern m-0 shadow-sm" style="padding: 0.5rem 1rem;">
                        <option value="all">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <a class="btn btn-modern px-4" href="{{ route('news.create') }}">
                    <i class="bi bi-plus-lg"></i> Add News
                </a>
            </div>
        </div>
      
        @if ($message = Session::get('success'))
        <div class="alert alert-success rounded-3 shadow-sm mb-4">
            <p class="mb-0">{{ $message }}</p>
        </div>
        @endif
        
        <div class="row g-4" id="newsContainer">
            @foreach ($news as $article)
            <div class="col-md-4 col-sm-6 news-article" data-status="{{ $article->status }}">
                <div class="card h-100 border-0 overflow-hidden shadow-sm" style="border-radius: 16px; background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); transition: transform 0.3s ease;">
                    <div class="position-relative">
                        @if($article->image)
                            <img class="card-img-top" src="{{ asset('assets/images/' . $article->image) }}" alt="News Image" style="height: 200px; object-fit: cover; object-position: center;">
                        @else
                            <div class="d-flex justify-content-center align-items-center bg-light" style="height: 200px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 p-3">
                            @if($article->status == 1)
                                <span class="badge bg-success rounded-pill px-3 shadow">Active</span>
                            @else
                                <span class="badge bg-secondary rounded-pill px-3 shadow">Inactive</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body d-flex flex-column p-4">
                        <h4 class="card-title fw-bold text-dark mb-2" style="font-size: 1.25rem;">{{ $article->title }}</h4>
                        <p class="card-text text-muted mb-4" style="font-size: 0.95rem; line-height: 1.5; flex-grow: 1;">{{ Str::limit($article->description, 100) }}</p>
                        
                        <div class="d-flex justify-content-between pt-3 border-top border-light mt-auto">
                            <form action="{{ route('news.destroy', $article->id) }}" method="POST" class="w-100 d-flex gap-2 justify-content-center">
                                <a href="{{ route('news.show', $article->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3 w-100">Show</a>
                                <a href="{{ route('news.edit', $article->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 w-100">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .news-article .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const container = document.getElementById('newsContainer');
        
        container.style.opacity = '0.5'; // visual loading cue
        
        axios.post('{{ route("news.filter") }}', {
            status: status
        })
        .then(function (response) {
            container.innerHTML = response.data;
            container.style.opacity = '1';
        })
        .catch(function (error) {
            console.error('Error fetching filtered news:', error);
            container.style.opacity = '1';
        });
    });
</script>
@endsection

