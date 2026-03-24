<nav class="navbar navbar-expand-lg mb-4 glass-navbar" style="border-bottom: 1px solid var(--glass-border); box-shadow: var(--card-shadow); padding: 1rem 0; z-index: 1000;">
    <div class="container">
        <div class="navbar-brand d-flex align-items-center gap-3" style="cursor: default;">
            <img src="{{asset('assets/images/dd.jpg') }}" style="width: 45px; height: 45px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); object-fit: cover;">
            <span class="fw-bold" style="color: var(--primary-color); font-size: 1.3rem; letter-spacing: -0.5px;">University Platform</span>
        </div>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            
            @auth
            <!-- Left aligned nav items (Authenticated) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('students*')) ? 'active' : '' }}" href="{{ route('students.index') }}">
                        <i class="bi bi-people me-1"></i> Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('news*')) ? 'active' : '' }}" href="{{ route('news.index') }}">
                        <i class="bi bi-newspaper me-1"></i> News
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->routeIs('api.universities') || request()->routeIs('search-universities') || request()->routeIs('fetch-universities')) ? 'active' : '' }}" href="{{ route('api.universities') }}">
                        <i class="bi bi-hdd-network me-1"></i> API's
                    </a>
                </li>
            </ul>
            @endauth

            <!-- Right aligned nav items -->
            <ul class="navbar-nav ms-auto gap-3 align-items-lg-center">
                @guest
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}" style="font-weight: 600;">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-modern px-4 py-2" href="{{ route('register') }}" style="color: white !important;">Register</a>
                    </li>
                @else    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 px-3 py-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 600; background: rgba(255,255,255,0.5); border-radius: 12px; border: 1px solid var(--glass-border);">
                            <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; flex-shrink: 0; background: var(--primary-color);">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="d-none d-lg-block">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-modern mt-2 border-0 shadow-lg p-2" style="border-radius: 16px;">
                            <li>
                                <a class="dropdown-item py-2 px-3 rounded-3" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2 text-danger"></i><span class="text-danger fw-semibold">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> 
