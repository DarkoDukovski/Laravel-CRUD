<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome - University Platform</title>
  <link rel="icon" href="https://fav.farm/🎓">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
  @include('navbar')

  <div class="container mt-5">
        @if(isset($activeNews) && $activeNews->count() > 0)
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold" style="color: var(--primary-color);">Latest News & Announcements</h2>
                    <p class="text-muted">Stay up to date with the recent updates</p>
                </div>
            </div>
            <div class="row">
                @foreach ($activeNews as $article)
                    <div class="col-md-4 mb-4 news-article" data-status="{{ $article->status }}">
                        <div class="glass-container h-100 m-0 p-4 d-flex flex-column">
                            <h4 class="card-title text-center fw-bold mb-3" style="color: var(--text-color);">{{ $article->title }}</h4>
                            <div class='d-flex justify-content-center mb-3 mt-2'>
                                <img class='news-image img-fluid rounded' style="box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-height: 200px; object-fit: cover;" src="{{ asset('assets/images/' . $article->image)}}" alt='News Image'>
                            </div>
                            <p class="card-text add-read-more show-less-content flex-grow-1 text-break">{{ $article->description }}</p>
                            <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center" style="border-color: var(--glass-border) !important;">
                                <span class="badge {{ $article->status == 1 ? 'bg-success' : 'bg-secondary' }} px-3 py-2 rounded-pill">
                                    {{ $article->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                                <a href="{{ route('news.show', $article->id) }}" class="btn btn-sm btn-modern-outline rounded-pill px-3">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 text-center mt-4">
                    <div class="glass-container p-5">
                        <i class="bi bi-newspaper mb-3" style="font-size: 5rem; color: #cbd5e1; display: inline-block;"></i>
                        <h2 class="mt-3 fw-bold" style="color: var(--primary-color);">Welcome to University Platform</h2>
                        <p class="text-muted mt-3 mb-4" style="font-size: 1.1rem; max-width: 500px; margin: 0 auto;">
                            There are currently no active news articles or announcements to display. Please check back later for updates.
                        </p>
                        
                        @guest
                        <div class="mt-4 pt-4 border-top" style="border-color: var(--glass-border) !important;">
                            <p class="text-muted mb-4">Get started by logging into your account or registering a new one.</p>
                            <a href="{{ route('login') }}" class="btn btn-modern px-5 py-2 me-3">Login to Account</a>
                            <a href="{{ route('register') }}" class="btn btn-modern-outline rounded-pill px-5 py-2">Register</a>
                        </div>
                        @else
                        <div class="mt-4 pt-4 border-top" style="border-color: var(--glass-border) !important;">
                            <a href="{{ route('dashboard') }}" class="btn btn-modern px-5 py-2">Go to Dashboard</a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        @endif
    </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    $(document).ready(function(){
        var carLmt = 150;
        var readMoreTxt = " ...read more";
        var readLessTxt = " read less";
     
        $(".add-read-more").each(function () {
            if ($(this).find(".first-section").length) return;
            var allstr = $(this).text();
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = firstSet + "<span class='second-section d-none'>" + secdHalf + "</span><span class='read-more text-primary' style='cursor:pointer; font-weight:500;' title='Click to Show More'>" + readMoreTxt + "</span><span class='read-less text-primary d-none' style='cursor:pointer; font-weight:500;' title='Click to Show Less'>" + readLessTxt + "</span>";
                $(this).html(strtoadd);
            }
        });
     
        $(document).on("click", ".read-more,.read-less", function () {
            var el = $(this).closest(".add-read-more");
            el.find(".second-section").toggleClass('d-none');
            el.find(".read-more").toggleClass('d-none');
            el.find(".read-less").toggleClass('d-none');
        });
    });
  </script>
</body>
</html>
