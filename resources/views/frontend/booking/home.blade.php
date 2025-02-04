@extends('frontend.booking.__layout_booking')


@section('booking-content')

    <livewire:frontend.city-form/>

@endsection


@pushonce('styles')
    <link href="{{ asset('assets/frontend/css/slimselect.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/slider.css') }}" rel="stylesheet"/>
    <script src="{{ asset('assets/frontend/js/lazysizes.min.js') }}" async></script>
@endpushonce

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
                            this.$wire.onCityChange(newVal[0].value);
                        }
                    }
                });
            },
            resetDate() {
                this.selectedCity = null;
            },
        }))
    });


</script>
@endpushonce


