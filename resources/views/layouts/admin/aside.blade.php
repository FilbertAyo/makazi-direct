<aside class="w-64 min-h-[calc(100vh-4rem)] flex flex-col bg-white border-r border-gray-200" x-data="{ usersOpen: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
    <!-- Logo (same as header) -->
    <div class="shrink-0 flex items-center h-16 px-4 border-b border-gray-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>

    <!-- Side navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            {{ __('Dashboard') }}
        </a>

        <!-- Users dropdown -->
        <div class="pt-1">
            <button type="button" @click="usersOpen = ! usersOpen"
                    class="flex items-center justify-between w-full gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    {{ __('Users') }}
                </span>
                <svg class="h-4 w-4 shrink-0 transition-transform" :class="{ 'rotate-180': usersOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <div x-show="usersOpen" x-transition class="mt-1 ml-4 space-y-0.5 border-l border-gray-200 pl-3">
                <a href="{{ route('admin.users.index') }}"
                   class="block py-1.5 text-sm {{ !request()->query('role') && request()->routeIs('admin.users.*') ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                    {{ __('All Users') }}
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
                   class="block py-1.5 text-sm {{ request()->query('role') === 'admin' ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                    {{ __('Admins') }}
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}"
                   class="block py-1.5 text-sm {{ request()->query('role') === 'tenant' ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                    {{ __('Tenants') }}
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}"
                   class="block py-1.5 text-sm {{ request()->query('role') === 'landlord' ? 'text-indigo-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">
                    {{ __('Landlords') }}
                </a>
            </div>
        </div>

        <a href="{{ route('admin.landlords.pending') }}"
           class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.landlords.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            {{ __('Pending Landlords') }}
        </a>
    </nav>
</aside>
