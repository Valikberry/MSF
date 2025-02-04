@extends('frontend.booking.__layout')


@section('main-content')

    <main>
        <div class="container">

            <div class="slider_wp">

                <div class="slider">
                    <div>

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

                        <div class="form_body">

                            <div class="step_wp">
                                <p class="step_txt">Step {{ $step }} of 5</p>
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

                            @yield('booking-content')

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>



@endsection


@pushonce('scripts')
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
@endpushonce

