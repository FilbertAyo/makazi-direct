<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
                <img src="{{ asset('assets/images/logo.svg') }}" class="img-fluid logo-lg" style="height: 50px; width: auto;" alt="logo">
                <img src="{{ asset('assets/images/logo.svg') }}" class="img-fluid logo-sm" style="height: 50px; width: auto;" alt="logo icon">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>{{ __('Users') }}</label>
                    <i class="ti ti-users"></i>
                </li>
                <li class="pc-item {{ request()->query('role') === 'admin' ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">{{ __('Admins') }}</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->query('role') === 'tenant' ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">{{ __('Tenants') }}</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->query('role') === 'landlord' ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">{{ __('Landlords') }}</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>{{ __('Landlord Workflows') }}</label>
                    <i class="ti ti-building-community"></i>
                </li>
                <li class="pc-item {{ request()->routeIs('admin.landlords.pending') ? 'active' : '' }}">
                    <a href="{{ route('admin.landlords.pending') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-clock"></i></span>
                        <span class="pc-mtext">{{ __('Pending Landlords') }}</span>
                        @if (($adminNotifications['pendingLandlords'] ?? 0) > 0)
                            <span class="pc-badge">{{ $adminNotifications['pendingLandlords'] }}</span>
                        @endif
                    </a>
                </li>
                <li class="pc-item {{ request()->routeIs('admin.landlords.index') || request()->routeIs('admin.landlords.show') ? 'active' : '' }}">
                    <a href="{{ route('admin.landlords.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-id-badge-2"></i></span>
                        <span class="pc-mtext">{{ __('Landlord Profiles') }}</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->routeIs('admin.properties.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.properties.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-building-estate"></i></span>
                        <span class="pc-mtext">{{ __('Landlord Properties') }}</span>
                    </a>
                </li>
                <li class="pc-item {{ request()->routeIs('admin.properties.moderation') ? 'active' : '' }}">
                    <a href="{{ route('admin.properties.moderation') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shield-check"></i></span>
                        <span class="pc-mtext">{{ __('Property Moderation') }}</span>
                        @if (($adminNotifications['pendingProperties'] ?? 0) > 0)
                            <span class="pc-badge">{{ $adminNotifications['pendingProperties'] }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
