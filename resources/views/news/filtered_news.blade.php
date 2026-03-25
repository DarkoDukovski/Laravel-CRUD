<!-- filtered_news.blade.php -->

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
            <p class="card-text text-muted mb-4 text-break" style="font-size: 0.95rem; line-height: 1.5; flex-grow: 1;">{{ Str::limit($article->description, 100) }}</p>
            
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

