@extends('frontend.booking.__layout')

@section('main-content')

    @if(false)
        <livewire:frontend.booking-confirmation-modal/>
    @endif

    <main>
        <div class="container">

            <div class="booking-detail thankyou">
                <div class="">

                    <div class="success-title">
                        <figure>
                            <img src="{{ asset('assets/frontend/images/icon-tick.svg') }}"
                                 srcset="{{ asset('assets/frontend/images/icon-tick.svg') }}"
                                 alt="tick icon"
                            />
                        </figure>

                        <h3>@lang('Your Booking Has Been Confirmed')</h3>
                        <p class="confirm_message">@lang('Your order has been placed and confirmed. Please find the details below:')</p>
                        <div>
                            <figure>
                                <ul class="logo-list">
                                    <li class="logo-item">
                                        <img src="{{ asset('assets/frontend/images/social_media/icon-facebook.svg') }}"
                                             srcset="{{ asset('assets/frontend/images/social_media/icon-facebook.svg') }}"
                                             alt="facebook logo"
                                        />
                                    </li>
                                    <li class="logo-item">
                                        <img src="{{ asset('assets/frontend/images/social_media/icon-twitter.svg') }}"
                                             srcset="{{ asset('assets/frontend/images/social_media/icon-twitter.svg') }}"
                                             alt="twitter logo"
                                        />
                                    </li>
                                    <li class="logo-item">
                                        <img src="{{ asset('assets/frontend/images/social_media/icon-instagram.svg') }}"
                                             srcset="{{ asset('assets/frontend/images/social_media/icon-instagram.svg') }}"
                                             alt="instagram logo"
                                        />
                                    </li>
                                    <li class="logo-item">
                                        <img src="{{ asset('assets/frontend/images/social_media/icon-linkedin.svg') }}"
                                             srcset="{{ asset('assets/frontend/images/social_media/icon-linkedin.svg') }}"
                                             alt="linkedin logo"
                                        />
                                    </li>
                                </ul>

                            </figure>
                        </div>
                    </div>

                    <div class="order-info">
                        <div class="order-details row">
                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Name'):</span>
                                    <p class="info-value">{{ $booking->name }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Email'):</span>
                                    <p class="info-value">{{ $booking->email }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Phone Number'):</span>
                                    <p class="info-value">{{ getPhoneCode() }} {{ $booking->phone_no }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('WhatsApp Phone Number'):</span>
                                    <p class="info-value">{{ $booking->whatsapp_no }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Pick Up Locations'):</span>
                                    @foreach($booking->pick_locations as $location)
                                        <p class="info-value">
                                            A{{ $loop->index+1 }}. {{ trim($location['address']) }},
                                            @lang('Floor'): {{ $location['floor'] }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Drop Off Locations'):</span>
                                    @foreach($booking->drop_locations as $location)
                                        <p class="info-value">
                                            A{{ $loop->index+1 }}. {{ $location['address'] }},
                                            @lang('Floor'): {{ $location['floor'] }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Date Of Move'):</span>
                                    <p class="info-value">{{ getReadableDate($booking->moving_date) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="user-details">
                                    <span class="info-title">@lang('Time Of Move'):</span>
                                    <p class="info-value">{{ getReadableTime($booking->moving_time) }}</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="user-details">
                                    <span class="info-title">@lang('Items To Be Moved'):</span>
                                    <p class="info-value">
                                        @foreach($booking->moving_items as $item)
                                            {{ $item['name'] }}<?php echo !$loop->last ? ', ' : ''; ?>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="user-details">
                                    <span class="info-title">@lang('Comment'):</span>
                                    <p class="info-value">
                                        {!! $booking->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="page-break"></div>

                        <div class="container">
                            <div class="item-title row">
                                <div class="col-sm-6">@lang('Item')</div>
                                <div class="col-sm-2">@lang('Quantity')</div>
                                <div class="col-sm-2">@lang('Price')</div>
                                <div class="col-sm-2">@lang('Total')</div>
                            </div>
                            <?php $total = 0; ?>
                            @foreach($booking->services as $service)
                                <div class="item-detail row">
                                    <div class="col-sm-6">
                                        <p>{{ $service['company_name'] }} - {{ $service['city_name'] }}</p>
                                        <p>{{ $service['service_name'] }}</p>
                                        @if(false)
                                            <p>@lang('Verification Status') - @lang('Verified')</p>
                                        @endif
                                    </div>
                                    <div class="col-sm-2">
                                        {{ $service['quantity'] }} {{ getPerServiceMeasureType($service['service_type']) }}
                                    </div>
                                    <div class="col-sm-2">{!! showPrice($service['price']) !!}</div>
                                    <div class="col-sm-2">{!! showPrice($service['total']) !!}</div>
                                </div>
                                    <?php $total += ($service['total'] ?? 0) ?>
                            @endforeach

                            <div class="item-detail row">
                                <div class="col-sm-2 offset-sm-8">
                                    <p class="btxt service-subtotal">@lang('Sub Total')</p>
                                    <p class="vbtxt service-total">@lang('Total')</p>
                                </div>
                                <div class="col-sm-2">
                                    <p class="btxt service-subtotal">{!! showPrice($total) !!}</p>
                                    <p class="vbtxt service-total">{!! showPrice($total) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="message-wrapper">
                    <div class="final-message">
                        <div class="info-title">@lang('Best Regards'),</div>
                        <p>{{ getAppName() }}</p>
                    </div>
                    <a class="print-wrapper clickable" onclick="window.print();">
                        <figure>
                            <img src="{{ asset('assets/frontend/images/icon_print_receipt.svg') }}"
                                 srcset="{{ asset('assets/frontend/images/icon_print_receipt.svg')}}"
                                 alt="print icon"
                            />
                        </figure>
                        <span>@lang('Print Receipt')</span>
                    </a>

                </div>

            </div>
        </div>

        </div>
    </main>
@endsection

