<aside class="landlord-sidebar flex-shrink-0">
    <nav class="nav flex-column py-3">
        @role('landlord')
            <a class="nav-link {{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}"
               href="{{ route('landlord.dashboard') }}">
                <i class="bi bi-grid-1x2"></i>
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs(['landlord.properties.index', 'landlord.properties.show', 'landlord.properties.edit']) ? 'active' : '' }}"
               href="{{ route('landlord.properties.index') }}">
                <i class="bi bi-house-door"></i>
                My Properties
            </a>
            <a class="nav-link {{ request()->routeIs('chatify') || request()->is('chatify*') ? 'active' : '' }}"
               href="{{ route('chatify') }}">
                <i class="bi bi-chat-dots"></i>
                Chats
            </a>
            <hr class="my-2">
        @endrole

        @role('tenant')
            <a class="nav-link {{ request()->routeIs('tenant.dashboard') ? 'active' : '' }}"
               href="{{ route('tenant.dashboard') }}">
                <i class="bi bi-grid-1x2"></i>
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('rentals.*') ? 'active' : '' }}"
               href="{{ route('rentals.index') }}">
                <i class="bi bi-search"></i>
                Browse rentals
            </a>
            <a class="nav-link {{ request()->routeIs('chatify') || request()->is('chatify*') ? 'active' : '' }}"
               href="{{ route('chatify') }}">
                <i class="bi bi-chat-dots"></i>
                Chats
            </a>
            <hr class="my-2">
        @endrole

        <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
           href="{{ route('profile.edit') }}">
            <i class="bi bi-person"></i>
            Profile
        </a>
        <a class="nav-link" href="{{ url('/') }}">
            <i class="bi bi-arrow-left-circle"></i>
            Back to site
        </a>
    </nav>
</aside>