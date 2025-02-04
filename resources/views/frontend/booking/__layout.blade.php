<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Booking') | {{ getAppName() }}</title>
    <meta name="title" content="{{ setting('meta_title') }}">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keywords" content="{{ setting('meta_keywords') }}">
    <meta name="author" content="{{ getAuthor() }}">
    <link rel="icon" href="{{ getFaviconUrl() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @stack('styles')
    @if(isInProduction())
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.min.css?version='.rand(0, 1000)) }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css?version='.rand(0, 1000)) }}">
    @endif
</head>
<body>
<header>
    <div class="container">
        <div class="header-content">
            <a href="{{ url('/') }}" class="logo-area">
                <img src="{{ getLogoUrl() }}" alt="logo" class="site-logo">
                <p class="site-name">@lang('Book Your Spot Now!')</p>
            </a>

            <livewire:frontend.cart class="" />
        </div>

    </div>
</header>

@yield('main-content')

<footer class="footer no-print">
    <div class="container">

        <div class="footer-nav">
            <dl>
                @foreach(setting('footer_links') as $footerLink)
                    <dt><a href="{{ $footerLink['link'] }}" target="_blank">{{ $footerLink['name'] }}</a></dt>
                @endforeach
            </dl>
        </div>
        <div class="footer-info">
            {!! setting('footer_content') !!}
        </div>

        <div class="social-area">
            <dl>
                @foreach(setting('social_links') as $socialLink)
                    <dt>
                        <a target="_blank" href="{{ $socialLink['link'] }}">
                            <i class="fa-brands {{ $socialLink['icon'] }}"></i>
                        </a>
                    </dt>
                @endforeach
            </dl>
        </div>
        <p class="footer-text">@lang('All rights reserved')</p>
    </div>
</footer>

<livewire:scripts/>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('openMoverModal', (event) => {
            let body = document.getElementsByTagName('body');
            body[0].classList.add('modal-open');
        });
        Livewire.on('closeMoverModal', (event) => {
            let body = document.getElementsByTagName('body');
            body[0].classList.remove('modal-open');
        });
    });

    document.addEventListener('click', function(event) {
        let clickaways = document.querySelectorAll('[wire\\:clickaway]');
        for(let i = 0; i < clickaways.length; i++) {
            var hasClickedInside = clickaways[i].contains(event.target);
            if (!hasClickedInside) {
                event = clickaways[i].getAttribute('wire:clickaway');
                window.Livewire.dispatch(event);
            }
        }
    });
</script>
@stack('scripts')
</body>
</html>
