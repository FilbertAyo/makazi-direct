@extends('layouts.clients.app')

@section('title', 'Messages')

@push('head')
<meta name="id" content="{{ $id }}">
<meta name="messenger-color" content="{{ $messengerColor }}">
<meta name="messenger-theme" content="{{ $dark_mode }}">
<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ Auth::user()->id }}">
@endpush

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css"/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.$dark_mode.'.mode.css') }}" rel="stylesheet" />
<style>
    /* ── Brand integration ───────────────────────────────────────────── */
    :root {
        --primary-color: #078c00;   /* Makazi Direct accent green */
    }

    /* Messenger wrapper: bleed to edges of the dashboard main area */
    .messenger-embed-wrapper {
        margin: -1.5rem -2rem -2rem;
        min-height: calc(100vh - 120px);
        position: relative;
    }
    .messenger-embed-wrapper .messenger {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
    }

    /* Use the project's font inside the messenger */
    .messenger,
    .messenger * {
        font-family: 'Work Sans', sans-serif !important;
    }

    /* Header: match sidebar nav active style */
    .messenger .m-header {
        background-color: #fff;
        border-bottom: 1px solid #e9ecef;
    }
    .messenger .m-header nav a {
        color: #078c00;
    }
    .messenger .m-header nav a:hover {
        color: #056300;
    }
    .messenger .m-header-right a {
        color: #4B5563;
    }
    .messenger .m-header-right a:hover {
        color: #078c00;
    }

    /* Sidebar list title */
    .messenger .messenger-title span {
        color: #078c00;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Active contact highlight */
    .messenger .messenger-list-item.active tr,
    .messenger .messenger-list-item tr:hover {
        background-color: rgba(7, 140, 0, 0.06);
    }

    /* Send button */
    .messenger .send-button {
        color: #078c00;
    }
    .messenger .send-button:hover {
        color: #056300;
    }

    /* NProgress: brand green */
    #nprogress .bar { background: #078c00 !important; }
    #nprogress .peg { box-shadow: 0 0 10px #078c00, 0 0 5px #078c00 !important; }
    #nprogress .spinner-icon {
        border-top-color: #078c00 !important;
        border-left-color: #078c00 !important;
    }

    @media (max-width: 991.98px) {
        .messenger-embed-wrapper {
            margin: -1rem;
            min-height: calc(100vh - 100px);
        }
    }
</style>
@endpush

@section('content')
<div class="messenger-embed-wrapper">
<div class="messenger">

    {{-- ── Contacts / list panel ──────────────────────────────────────── --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        <div class="m-header">
            <nav>
                <a href="#">
                    <i class="fas fa-inbox"></i>
                    <span class="messenger-headTitle">MESSAGES</span>
                </a>
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            <input type="text" class="messenger-search" placeholder="Search contacts…" />
        </div>

        <div class="m-body contacts-container">
            <div class="show messenger-tab users-tab app-scroll" data-view="users">
                <div class="favorites-section">
                    <p class="messenger-title"><span>Favorites</span></p>
                    <div class="messenger-favorites app-scroll-hidden"></div>
                </div>
                <p class="messenger-title"><span>Your Space</span></p>
                {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
                <p class="messenger-title"><span>All Messages</span></p>
                <div class="listOfContacts" style="width:100%;height:calc(100% - 272px);position:relative;"></div>
            </div>
            <div class="messenger-tab search-tab app-scroll" data-view="search">
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search…</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Messaging panel ─────────────────────────────────────────────── --}}
    <div class="messenger-messagingView">
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin:0 10px -5px;"></div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite" title="Favourite"><i class="fas fa-star"></i></a>
                    {{-- Home icon goes to the right dashboard for each role --}}
                    <a href="{{ auth()->user()->hasRole('landlord') ? route('landlord.dashboard') : route('tenant.dashboard') }}" title="Dashboard">
                        <i class="fas fa-home"></i>
                    </a>
                    <a href="#" class="show-infoSide" title="Details"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting…</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Select a conversation to start messaging</span></p>
            </div>
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @include('Chatify::layouts.sendForm')
    </div>

    {{-- ── Info / details panel ────────────────────────────────────────── --}}
    <div class="messenger-infoView app-scroll">
        <nav>
            <p>User Details</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>

</div>
</div>

@include('Chatify::layouts.modals')
@endsection

@push('scripts')
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
<script>
    window.chatify = {
        name: "{{ config('chatify.name') }}",
        sounds: {!! json_encode(config('chatify.sounds')) !!},
        allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
        allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
        maxUploadSize: {{ Chatify::getMaxUploadSize() }},
        pusher: {!! json_encode(config('chatify.pusher')) !!},
        pusherAuthEndpoint: '{{ route("pusher.auth") }}'
    };
    window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
</script>
<script src="{{ asset('js/chatify/utils.js') }}"></script>
<script src="{{ asset('js/chatify/code.js') }}"></script>
<script>
// Auto-open the conversation when landing via /chatify/{id}
// (e.g. redirected from "Chat with landlord" on the rental page).
(function () {
    function openConversation() {
        var id = $('meta[name=id]').attr('content');
        if (!id || id === '0') return;
        if (typeof IDinfo !== 'function') return;

        // Give Chatify's JS a moment to finish bootstrapping contacts
        setTimeout(function () {
            IDinfo(id);
            // On narrow screens show only the messaging pane
            if (window.innerWidth <= 900) {
                $('.messenger-listView').hide();
                $('.messenger-messagingView').show();
            }
        }, 700);
    }

    if (document.readyState === 'loading') {
        $(document).ready(openConversation);
    } else {
        openConversation();
    }
}());
</script>
@endpush
