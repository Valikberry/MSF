@extends('frontend.booking.__layout_booking')


@section('booking-content')

    <?php $step = getBookingStep(); ?>

    @if($step == \App\Enums\BookingStep::contact->value)
        <livewire:frontend.contact-form/>
    @endif

    @if($step == \App\Enums\BookingStep::location->value)
        <livewire:frontend.location-form/>
    @endif

    @if($step == \App\Enums\BookingStep::moving_object->value)
        <livewire:frontend.moving-detail-form/>
    @endif

    @if($step == \App\Enums\BookingStep::payment->value)
        <livewire:frontend.payment-form/>
    @endif

@endsection


@pushonce('scripts')
<script src="{{ asset('assets/frontend/js/flatpickr.js') }}"></script>
<script src="{{ asset('assets/frontend/js/slimselect.min.js') }}"></script>
<script>

    document.addEventListener('alpine:init', () => {
        Alpine.data('select2', (model) => ({
            selectedCity: model,
            selector: null,
            init() {
                new SlimSelect({
                    select: this.$refs.city_id,
                    settings: {
                        //allowDeselect: true
                    },
                    events: {
                        afterChange: (newVal) => {
                            this.$wire.onCityChange();
                        }
                    }
                });
            },
            resetDate() {
                this.selectedCity = null;
            },
        }))
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('datepicker', (model) => ({
            selectedDate: model,
            init() {
                flatpickr(this.$refs.datepicker, {
                    defaultDate: this.selectedDate ? this.selectedDate.initialValue : null,
                    minDate: "today"
                });
            },
            resetDate() {
                this.selectedDate = null;
            },
        }));
    });

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

</script>

<script>
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
<script>
    function initializeLazyLoading() {
        const lazyImages = document.querySelectorAll('img.lazy');

        if ("IntersectionObserver" in window) {
            const lazyLoad = function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        observer.unobserve(img);
                    }
                });
            };

            const imageObserver = new IntersectionObserver(lazyLoad, {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            });

            lazyImages.forEach(img => {
                imageObserver.observe(img);
            });
        } else {
            // Fallback for older browsers
            lazyImages.forEach(img => {
                img.src = img.dataset.src;
            });
        }
    }

    // Initialize lazy loading on page load
    /*document.addEventListener("DOMContentLoaded", initializeLazyLoading);*/

    // Reinitialize lazy loading after Livewire updates
/*    document.addEventListener('livewire:init', initializeLazyLoading);
    document.addEventListener('livewire:update', initializeLazyLoading);*/

    document.addEventListener('livewire:init', function() {
        // Initialize lazy loading plugin
        initializeLazyLoading();
    });

    document.addEventListener('livewire:update', function() {
        // Reinitialize lazy loading plugin after Livewire updates
        initializeLazyLoading();
    });
</script>
@endpushonce

@pushonce('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flatpickr.min.css') }}">
    <link href="{{ asset('assets/frontend/css/slimselect.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slider.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
@endpushonce

