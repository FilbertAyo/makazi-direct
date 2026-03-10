@extends('layouts.landing')

@section('title', 'Contact Us – Makazi Direct')

@section('content')
<main class="py-5" style="padding-top: 100px;">
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-7">
                    <h1 class="h3 text-capitalize mb-3">Contact Us</h1>
                    <p class="text-muted mb-0">
                        Have a question about Makazi Direct, listings, or your account? Send us a message and we'll get back to you as soon as we can.
                    </p>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <p class="mb-1 text-muted"><i class="bi-envelope me-2"></i>support@makazidirect.com</p>
                    <p class="mb-0 text-muted"><i class="bi-telephone me-2"></i>+255 000 000 000</p>
                </div>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-lg-5">
                            <h2 class="h4 mb-4">Send us a message</h2>
                            <form method="POST" action="{{ route('contact.show') }}" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label text-uppercase small fw-semibold">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label text-uppercase small fw-semibold">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label text-uppercase small fw-semibold">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="How can we help?">
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label text-uppercase small fw-semibold">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Describe your question or issue" required></textarea>
                                </div>
                                <div class="col-12 d-grid mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg text-uppercase btn-rounded-none fs-6">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0 h-100 bg-white shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h5 mb-3">Support hours</h2>
                            <p class="text-muted">
                                Monday – Friday: 9:00 AM – 6:00 PM<br>
                                Saturday: 10:00 AM – 2:00 PM<br>
                                Sunday & public holidays: Closed
                            </p>
                            <h2 class="h5 mb-3 mt-4">Office</h2>
                            <p class="text-muted mb-0">
                                Dar es Salaam, Tanzania<br>
                                (Example address – update later)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
