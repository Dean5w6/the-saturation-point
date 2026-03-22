<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            <i class="fas fa-pen-nib me-2"></i> The Saturation Point
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Shop</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" href="#footer-contact" onclick="document.querySelector('footer').scrollIntoView({behavior: 'smooth'});">About</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ count(Session::get('cart', [])) }}
                        </span>
                    </a>
                </li>
                
                @guest
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm ms-2" href="{{ route('register') }}" style="border-color: var(--gold-accent); color: var(--gold-accent);">REGISTER</a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li><a class="dropdown-item fw-bold" style="color: var(--ink-blue);" href="{{ route('profile.edit') }}">My Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Manage Categories</a></li> 
                                <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Manage Products</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Manage Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manage Users</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.reviews.index') }}">Manage Reviews</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('orders.history') }}">My Orders</a></li>
                            @endif
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold">Logout</button>
                                </form>
                            </li>
                        </ul>
                        </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>