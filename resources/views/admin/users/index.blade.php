<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Role filter -->
            <div class="mb-4 flex flex-wrap gap-2">
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium {{ $role === null ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ __('All') }}
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
                   class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium {{ $role === 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ __('Admins') }}
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'tenant']) }}"
                   class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium {{ $role === 'tenant' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ __('Tenants') }}
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'landlord']) }}"
                   class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium {{ $role === 'landlord' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ __('Landlords') }}
                </a>
            </div>

            @if ($users->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ $role
                            ? __('No users found for this role.')
                            : __('No users yet.') }}
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Email') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Phone') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Role') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Registered') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email ?? '—' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->phone ?? '—' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @foreach ($user->roles as $r)
                                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 capitalize">{{ $r->name }}</span>
                                            @endforeach
                                            @if ($user->roles->isEmpty())
                                                —
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium
                                                {{ $user->status === \App\Models\User::STATUS_ACTIVE ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $user->status === \App\Models\User::STATUS_PENDING ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $user->status === \App\Models\User::STATUS_REJECTED ? 'bg-red-100 text-red-800' : '' }}
                                                {{ !in_array($user->status ?? '', [\App\Models\User::STATUS_ACTIVE, \App\Models\User::STATUS_PENDING, \App\Models\User::STATUS_REJECTED], true) ? 'bg-gray-100 text-gray-800' : '' }}
                                            ">
                                                {{ $user->status ?? '—' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('M j, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-3 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
