<?php

namespace App\Http\Requests;

use App\Models\Property;
use App\Models\PropertyContact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('property')) ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'minimum_rent_months' => ['required', 'integer', 'min:1', 'max:60'],
            'property_type' => ['required', Rule::in(array_keys(Property::propertyTypes()))],
            'bedrooms' => ['required', 'integer', 'min:0', 'max:50'],
            'living_rooms' => ['required', 'integer', 'min:0', 'max:20'],
            'bathrooms' => ['required', 'integer', 'min:0', 'max:20'],
            'kitchens' => ['required', 'integer', 'min:0', 'max:10'],
            'has_fence' => ['boolean'],
            'has_parking' => ['boolean'],
            'dimensions' => ['nullable', 'string', 'max:2000'],
            'description' => ['nullable', 'string', 'max:5000'],
            'house_rules' => ['nullable', 'string', 'max:5000'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'distance_from_main_road' => ['nullable', 'string', 'max:255'],
            'contacts' => ['nullable', 'array', 'max:6'],
            'contacts.*.label' => ['nullable', 'string', 'max:50'],
            'contacts.*.type' => ['required_with:contacts.*.value', Rule::in(array_keys(PropertyContact::contactTypes()))],
            'contacts.*.value' => ['required_with:contacts.*.type', 'string', 'max:255'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer', 'exists:property_images,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'has_fence' => $this->boolean('has_fence'),
            'has_parking' => $this->boolean('has_parking'),
        ]);
    }
}
