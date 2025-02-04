<div>
    @if(getBookingStep() != \App\Enums\BookingStep::service->value)

        <div class="slogan">
            <h2>@lang('Find & Book Independent, Reliable Moving Services in Finland')</h2>
            <div class="slogan-bottom">
                <img src="{{ asset('assets/frontend/images/icon-red-calendar.svg') }}"
                     alt="calendar"
                />
                <i class="slogan-book">@lang('Book Online 24/7')</i>
            </div>
        </div>

        <div class="slider_header">

            @foreach($sliders as $slider)
                <input class="carousel__btn" type="radio" name="carousel-control"
                       id="carousel__btn{{ $slider->id }}" hidden/>
            @endforeach

            <div class="carousel">
                <div class="carousel__slides">

                    @foreach($sliders as $slider)
                        <div class="carousel__slid">
                            <div class="profile">
                                <img src="{{ getSliderImageUrl($slider->image) }}" alt="" class="profile_img">
                                <div class="pro_txt">
                                    <p class="pro_heading">{{ $slider->name }}</p>
                                    <p class="pro_para">{{ $slider->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel__control">
                    <label for="carousel__btn1" id="carousel__nav1" class="carousel__nav"></label>

                    <label for="carousel__btn2" id="carousel__nav2" class="carousel__nav"></label>

                    <label for="carousel__btn3" id="carousel__nav3" class="carousel__nav"></label>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has(\App\Libraries\Alert\AlertMessage::key()))
            <?php $message = session(\App\Libraries\Alert\AlertMessage::key()); ?>
        <div class="alert floating-alert alert-{{ $message['type'] }}"
             id="floating-alert"
             x-data="{ show: true }"
             x-init="setTimeout(() => document.getElementById('floating-alert').remove(), 4000)"
        >
            <a href="#" x-on:click.prevent="document.getElementById('floating-alert').remove()">
                <svg class="alert-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>

            <h6 class="alert-title">{{ $message['title'] }}</h6>
            <div class="alert-desc">
                {{ $message['description'] }}
            </div>
        </div>
    @endif


    <div class="form_body">

        @if(\App\Enums\BookingStep::service->value != getBookingStep())
            <div class="step_wp">
                <p class="step_txt">Step 1 of 5</p>
                <div class="step_points">
                    <div class="step_round {{ $step >= 1 ? 'active' : '' }}">
                        <div class="step_bolt"></div>
                    </div>
                    <div class="step_line {{ $step >= 2 ? 'active' : '' }}"></div>
                    <div class="step_round {{ $step >= 2 ? 'active' : '' }}">
                        <div class="step_bolt"></div>
                    </div>
                    <div class="step_line {{ $step >= 3 ? 'active' : '' }}"></div>
                    <div class="step_round {{ $step >= 3 ? 'active' : '' }}">
                        <div class="step_bolt"></div>
                    </div>
                    <div class="step_line {{ $step >= 4 ? 'active' : '' }}"></div>
                    <div class="step_round {{ $step >= 4 ? 'active' : '' }}">
                        <div class="step_bolt"></div>
                    </div>
                    <div class="step_line {{ $step >= 5 ? 'active' : '' }}"></div>
                    <div class="step_round {{ $step >= 5 ? 'active' : '' }}">
                        <div class="step_bolt"></div>
                    </div>
                </div>
            </div>
        @endif

        @if($step == \App\Enums\BookingStep::city->value)
            <livewire:frontend.city-form/>
        @endif

        @if($step == \App\Enums\BookingStep::service->value)
            <livewire:frontend.service-form/>
        @endif

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

    </div>

</div>

