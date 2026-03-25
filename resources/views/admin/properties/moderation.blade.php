@php($breadcrumbTitle = __('Property Moderation'))

<x-app-layout>
    <x-slot name="header">
        <div>
            <h5 class="m-b-10">{{ __('Property Moderation') }}</h5>
            <p class="mb-0 text-muted">{{ __('Review, verify, or hold landlord listings before publishing.') }}</p>
        </div>
    </x-slot>

    <div class="card shadow-none border tbl-card">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Landlord') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Submitted') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($properties as $property)
                        <tr>
                            <td>{{ ($properties->currentPage() - 1) * $properties->perPage() + $loop->iteration }}</td>
                            <td>{{ $property->title }}</td>
                            <td>{{ $property->landlord?->name ?? '—' }}</td>
                            <td>{{ number_format((float) $property->price) }}</td>
                            <td>{{ $property->created_at->format('M j, Y') }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-sm btn-light-primary border border-primary text-primary">{{ __('View') }}</a>
                                    <form action="{{ route('admin.properties.approve', $property) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="ti ti-check me-1"></i>{{ __('Approve') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">{{ __('No properties waiting for moderation.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body border-top">
            {{ $properties->links() }}
        </div>
    </div>
</x-app-layout>
