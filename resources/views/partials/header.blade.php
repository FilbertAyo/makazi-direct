   <!-- header with top bar and nav -->
   <header id="nav" class="site-header position-fixed w-100 bg-white shadow-none border-bottom" style="top: 0; z-index: 1030;">
       <!-- top bar start -->
       <div class="bg-dark text-white border-bottom small">
           <div class="container d-flex justify-content-between align-items-center py-1">
               <div class="d-flex align-items-center gap-3">
                   <span class="text-white">
                       <i class="bi-envelope me-1 text-white"></i><span class="d-none d-md-inline">support@makazidirect.com</span>
                   </span>
                   <span class="text-white">
                       <i class="bi-telephone me-1 text-white"></i><span class="d-none d-md-inline">+255 000 000 000</span>
                   </span>
               </div>
               <div class="d-flex align-items-center gap-3">
                   <a href="https://wa.me/255000000000" target="_blank" class="text-success text-decoration-none" aria-label="WhatsApp">
                       <i class="bi-whatsapp fs-5 text-white"></i>
                   </a>
                   <button type="button" class="btn btn-sm btn-outline-secondary d-flex align-items-center border-0 bg-transparent">
                       <span class="text-white">🇺🇸</span><span class="d-none d-md-inline ms-1 text-white">English</span>
                   </button>
               </div>
           </div>
       </div>

       <!-- nav bar start  -->
       <nav id="navbar-example2" class="navbar navbar-expand-lg py-2 navbar-light">
            <div class="container ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}"
                         alt="Makazi Direct" style="height: 50px; width: auto;">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2"
                        aria-label="Toggle navigation">
                    <ion-icon name="menu-outline" style="font-size: 30px;"></ion-icon>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
                     aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav align-items-center justify-content-end align-items-center flex-grow-1 ">
                            <li class="nav-item">
                                <a class="nav-link me-md-4 {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-md-4 {{ request()->routeIs('rentals.index') ? 'active' : '' }}" href="{{ route('rentals.index') }}">Rentals</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link me-md-4 {{ request()->routeIs('contact.show') ? 'active' : '' }}" href="{{ route('contact.show') }}">Contact</a>
                            </li>

                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-1">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">{{ __('Log Out') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="btn-medium btn btn-primary me-3" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn-medium btn btn-dark"
                                   href="{{ route('register') }}">Sign Up</a>
                            </li>
                            @endauth
                        </ul>

                        @auth
                        <!-- Mobile: account info (visible in offcanvas only) -->
                        <div class="pt-4 mt-4 border-top d-lg-none">
                            <div class="mb-2">
                                <div class="fw-semibold text-dark">{{ Auth::user()->name }}</div>
                                <div class="small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">{{ __('Log Out') }}</button>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>