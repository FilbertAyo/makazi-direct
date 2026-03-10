<x-guest-layout>
    <div class="mb-3">
        <div class="d-flex justify-content-between small text-muted mb-1">
            <span>{{ __('Step 3 of 3') }}</span>
            <span>{{ __('Landlord') }}</span>
        </div>
        <div class="progress" style="height: 6px;">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <h2 class="h3 mb-4 text-center">{{ __('Upload Documents') }}</h2>

    <p class="text-muted small mb-4">
        {{ __('Upload your NIDA and a recent electricity or water bill for verification. Your account will be reviewed by our team.') }}
    </p>

    <form method="POST" action="{{ route('register.landlord.documents.store') }}" enctype="multipart/form-data" class="form-group flex-wrap">
        @csrf

        <div class="form-input col-lg-12 my-3">
            <label for="nida" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('NIDA Document') }}</label>
            <input id="nida" type="file" name="nida" accept=".pdf,.jpg,.jpeg,.png" required
                   class="form-control ps-3 @error('nida') is-invalid @enderror">
            <div class="form-text">{{ __('PDF or image, max 5MB') }}</div>
            @error('nida')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-input col-lg-12 my-3">
            <label for="electricity_bill" class="form-label fs-6 text-uppercase fw-bold text-black">{{ __('Electricity or Water Bill') }}</label>
            <input id="electricity_bill" type="file" name="electricity_bill" accept=".pdf,.jpg,.jpeg,.png" required
                   class="form-control ps-3 @error('electricity_bill') is-invalid @enderror">
            <div class="form-text">{{ __('PDF or image, max 5MB') }}</div>
            @error('electricity_bill')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('register.landlord.details') }}" class="btn btn-outline-secondary">{{ __('Back') }}</a>
            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6" type="submit">
                {{ __('Submit for Approval') }}
            </button>
        </div>
    </form>
</x-guest-layout>
