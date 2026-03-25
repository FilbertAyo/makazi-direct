@php
    $isEdit = isset($property) && $property->exists;
    $property = $property ?? new \App\Models\Property();
    $contactTypes = $contactTypes ?? \App\Models\PropertyContact::contactTypes();
    $existingContacts = old('contacts', $isEdit ? $property->contacts->map(fn ($contact) => [
        'label' => $contact->label,
        'type' => $contact->type,
        'value' => $contact->value,
    ])->toArray() : []);
    if ($existingContacts === []) {
        $existingContacts = [['label' => '', 'type' => \App\Models\PropertyContact::TYPE_PHONE, 'value' => '']];
    }
@endphp

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h2 class="h5 text-capitalize mb-0">Basic details</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-12">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $property->title ?? '') }}" required maxlength="255">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price (per month) <span class="text-danger">*</span></label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror"
                       value="{{ old('price', $property->price ?? '') }}" min="0" step="0.01" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="minimum_rent_months" class="form-label">Minimum rental period (months) <span class="text-danger">*</span></label>
                <select name="minimum_rent_months" id="minimum_rent_months" class="form-select @error('minimum_rent_months') is-invalid @enderror" required>
                    @foreach ([1, 3, 6, 12, 24] as $m)
                        <option value="{{ $m }}" @selected(old('minimum_rent_months', $property->minimum_rent_months ?? 3) == $m)>{{ $m }} month(s)</option>
                    @endforeach
                </select>
                @error('minimum_rent_months')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="property_type" class="form-label">Property type <span class="text-danger">*</span></label>
                <select name="property_type" id="property_type" class="form-select @error('property_type') is-invalid @enderror" required>
                    @foreach ($propertyTypes as $value => $label)
                        <option value="{{ $value }}" @selected(old('property_type', $property->property_type ?? '') == $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('property_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h2 class="h5 text-capitalize mb-0">Rooms &amp; features</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <label for="bedrooms" class="form-label">Bedrooms</label>
                <input type="number" name="bedrooms" id="bedrooms" class="form-control @error('bedrooms') is-invalid @enderror"
                       value="{{ old('bedrooms', $property->bedrooms ?? 0) }}" min="0" max="50">
                @error('bedrooms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 col-md-3">
                <label for="living_rooms" class="form-label">Living rooms</label>
                <input type="number" name="living_rooms" id="living_rooms" class="form-control @error('living_rooms') is-invalid @enderror"
                       value="{{ old('living_rooms', $property->living_rooms ?? 0) }}" min="0" max="20">
                @error('living_rooms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 col-md-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" name="bathrooms" id="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror"
                       value="{{ old('bathrooms', $property->bathrooms ?? 0) }}" min="0" max="20">
                @error('bathrooms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 col-md-3">
                <label for="kitchens" class="form-label">Kitchens</label>
                <input type="number" name="kitchens" id="kitchens" class="form-control @error('kitchens') is-invalid @enderror"
                       value="{{ old('kitchens', $property->kitchens ?? 0) }}" min="0" max="10">
                @error('kitchens')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="has_fence" id="has_fence" value="1" class="form-check-input"
                           @checked(old('has_fence', $property->has_fence ?? false))>
                    <label for="has_fence" class="form-check-label">Fence</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="has_parking" id="has_parking" value="1" class="form-check-input"
                           @checked(old('has_parking', $property->has_parking ?? false))>
                    <label for="has_parking" class="form-check-label">Parking</label>
                </div>
            </div>
            <div class="col-12">
                <label for="dimensions" class="form-label">Dimensions / room sizes</label>
                <textarea name="dimensions" id="dimensions" class="form-control @error('dimensions') is-invalid @enderror" rows="2" maxlength="2000">{{ old('dimensions', $property->dimensions ?? '') }}</textarea>
                @error('dimensions')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h2 class="h5 text-capitalize mb-0">Description &amp; location</h2>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" maxlength="5000">{{ old('description', $property->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="house_rules" class="form-label">House rules and policies</label>
                <textarea name="house_rules" id="house_rules" class="form-control @error('house_rules') is-invalid @enderror" rows="4" maxlength="5000" placeholder="e.g. No pets, no loud noise after 10PM, rent due by 5th of each month.">{{ old('house_rules', $property->house_rules ?? '') }}</textarea>
                @error('house_rules')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="number" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror"
                       value="{{ old('latitude', $property->latitude ?? '') }}" step="any" placeholder="e.g. -6.792354">
                @error('latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="number" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror"
                       value="{{ old('longitude', $property->longitude ?? '') }}" step="any" placeholder="e.g. 39.208328">
                @error('longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="distance_from_main_road" class="form-label">Distance from main road</label>
                <input type="text" name="distance_from_main_road" id="distance_from_main_road" class="form-control @error('distance_from_main_road') is-invalid @enderror"
                       value="{{ old('distance_from_main_road', $property->distance_from_main_road ?? '') }}" maxlength="255" placeholder="e.g. 200m">
                @error('distance_from_main_road')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h2 class="h5 text-capitalize mb-0">Property contact details</h2>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">Add one or more contact methods that tenants can use after they log in.</p>
        <div id="contactRows" data-contact-types='@json($contactTypes)' class="d-flex flex-column gap-3">
            @foreach ($existingContacts as $index => $contact)
                <div class="row g-2 contact-row">
                    <div class="col-md-3">
                        <label class="form-label">Type</label>
                        <select name="contacts[{{ $index }}][type]" class="form-select @error('contacts.'.$index.'.type') is-invalid @enderror">
                            @foreach ($contactTypes as $typeValue => $typeLabel)
                                <option value="{{ $typeValue }}" @selected(($contact['type'] ?? '') === $typeValue)>{{ $typeLabel }}</option>
                            @endforeach
                        </select>
                        @error('contacts.'.$index.'.type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Label (optional)</label>
                        <input type="text" name="contacts[{{ $index }}][label]" class="form-control @error('contacts.'.$index.'.label') is-invalid @enderror"
                               value="{{ $contact['label'] ?? '' }}" maxlength="50" placeholder="e.g. Primary, Office">
                        @error('contacts.'.$index.'.label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Contact value</label>
                        <input type="text" name="contacts[{{ $index }}][value]" class="form-control @error('contacts.'.$index.'.value') is-invalid @enderror"
                               value="{{ $contact['value'] ?? '' }}" maxlength="255" placeholder="e.g. +255712345678">
                        @error('contacts.'.$index.'.value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100 remove-contact-row" title="Remove contact">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <button id="addContactRow" type="button" class="btn btn-outline-primary btn-sm mt-3">
            <i class="bi bi-plus-lg me-1"></i>Add contact
        </button>
        @error('contacts')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white border-bottom py-3">
        <h2 class="h5 text-capitalize mb-0">Photos</h2>
    </div>
    <div class="card-body">
        @if ($isEdit && $property->images->isNotEmpty())
            <p class="text-muted small mb-2">Current images (check to remove):</p>
            <div class="d-flex flex-wrap gap-2 mb-3">
                @foreach ($property->images as $img)
                    <label class="d-inline-block position-relative">
                        <img src="{{ $img->url }}" alt="" class="rounded border" style="width: 80px; height: 80px; object-fit: cover;">
                        <input type="checkbox" name="remove_images[]" value="{{ $img->id }}" class="form-check-input position-absolute top-0 start-0 m-1">
                    </label>
                @endforeach
            </div>
        @endif
        <label for="images" class="form-label">{{ $isEdit ? 'Add more photos' : 'Upload photos' }} (max 10, 5MB each)</label>
        <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp" multiple>
        @error('images.*')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @error('images')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var contactRows = document.getElementById('contactRows');
    var addBtn = document.getElementById('addContactRow');
    if (!contactRows || !addBtn) {
        return;
    }

    var typeOptions = JSON.parse(contactRows.dataset.contactTypes || '{}');

    function buildTypeSelect(index) {
        var options = Object.entries(typeOptions).map(function (entry) {
            return '<option value="' + entry[0] + '">' + entry[1] + '</option>';
        }).join('');

        return '<select name="contacts[' + index + '][type]" class="form-select">' + options + '</select>';
    }

    function refreshIndexes() {
        var rows = contactRows.querySelectorAll('.contact-row');
        rows.forEach(function (row, index) {
            var fields = row.querySelectorAll('input, select');
            fields.forEach(function (field) {
                field.name = field.name.replace(/contacts\[\d+\]/, 'contacts[' + index + ']');
            });
        });
    }

    addBtn.addEventListener('click', function () {
        var index = contactRows.querySelectorAll('.contact-row').length;
        var row = document.createElement('div');
        row.className = 'row g-2 contact-row';
        row.innerHTML = ''
            + '<div class="col-md-3"><label class="form-label">Type</label>' + buildTypeSelect(index) + '</div>'
            + '<div class="col-md-3"><label class="form-label">Label (optional)</label><input type="text" name="contacts[' + index + '][label]" class="form-control" maxlength="50" placeholder="e.g. Primary, Office"></div>'
            + '<div class="col-md-5"><label class="form-label">Contact value</label><input type="text" name="contacts[' + index + '][value]" class="form-control" maxlength="255" placeholder="e.g. +255712345678"></div>'
            + '<div class="col-md-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger w-100 remove-contact-row" title="Remove contact"><i class="bi bi-x-lg"></i></button></div>';

        contactRows.appendChild(row);
    });

    contactRows.addEventListener('click', function (event) {
        var removeBtn = event.target.closest('.remove-contact-row');
        if (!removeBtn) {
            return;
        }
        var rows = contactRows.querySelectorAll('.contact-row');
        if (rows.length === 1) {
            rows[0].querySelectorAll('input').forEach(function (input) {
                input.value = '';
            });
            rows[0].querySelector('select').selectedIndex = 0;
            return;
        }
        removeBtn.closest('.contact-row').remove();
        refreshIndexes();
    });
});
</script>
@endpush
