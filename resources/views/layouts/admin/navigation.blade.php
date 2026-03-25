<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ti ti-menu-2"></i></a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ti ti-menu-2"></i></a>
                </li>
                <li class="pc-h-item d-none d-md-inline-flex">
                    <form class="header-search">
                        <i data-feather="search" class="icon-search"></i>
                        <input type="search" class="form-control" placeholder="Search here. . .">
                    </form>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="ti ti-bell"></i>
                        @if (($adminNotifications['pendingLandlords'] ?? 0) + ($adminNotifications['pendingProperties'] ?? 0) > 0)
                            <span class="badge bg-danger rounded-pill ms-1">
                                {{ ($adminNotifications['pendingLandlords'] ?? 0) + ($adminNotifications['pendingProperties'] ?? 0) }}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">{{ __('Notifications') }}</h5>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px);">
                            <div class="list-group list-group-flush w-100">
                                <a href="{{ route('admin.landlords.pending') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-body mb-1">{{ __('Pending landlord applications') }}</p>
                                            <span class="text-muted">{{ __('Requires review and decision') }}</span>
                                        </div>
                                        <span class="badge bg-light-warning border border-warning text-warning">{{ $adminNotifications['pendingLandlords'] ?? 0 }}</span>
                                    </div>
                                </a>
                                <a href="{{ route('admin.properties.moderation') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-body mb-1">{{ __('Properties pending moderation') }}</p>
                                            <span class="text-muted">{{ __('Awaiting verification status') }}</span>
                                        </div>
                                        <span class="badge bg-light-primary border border-primary text-primary">{{ $adminNotifications['pendingProperties'] ?? 0 }}</span>
                                    </div>
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-body mb-1">{{ __('New users in last 7 days') }}</p>
                                            <span class="text-muted">{{ __('Track onboarding velocity') }}</span>
                                        </div>
                                        <span class="badge bg-light-success border border-success text-success">{{ $adminNotifications['newUsersThisWeek'] ?? 0 }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="{{ asset('admin/assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('admin/assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar wid-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">{{ Auth::user()->name }}</h6>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span>{{ __('Logout') }}</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
