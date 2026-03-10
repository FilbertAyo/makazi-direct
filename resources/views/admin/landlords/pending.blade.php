<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pending Landlord Applications') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">
                {{ __('Back to Admin Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if ($landlords->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __('No pending landlord applications.') }}
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Phone') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Email') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Documents') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Applied') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($landlords as $landlord)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $landlord->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $landlord->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $landlord->email ?? '—' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @foreach ($landlord->landlordDocuments as $doc)
                                                <a href="{{ route('admin.documents.show', $doc) }}" target="_blank" rel="noopener"
                                                   class="text-indigo-600 hover:underline block">
                                                    {{ $doc->type === 'nida' ? __('NIDA') : __('Bill') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $landlord->created_at->format('M j, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                            <form action="{{ route('admin.landlords.approve', $landlord) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:underline font-medium">
                                                    {{ __('Approve') }}
                                                </button>
                                            </form>
                                            <span class="mx-1">|</span>
                                            <form action="{{ route('admin.landlords.reject', $landlord) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('{{ __('Are you sure you want to reject this application?') }}');">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:underline font-medium">
                                                    {{ __('Reject') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-3 border-t border-gray-200">
                        {{ $landlords->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
