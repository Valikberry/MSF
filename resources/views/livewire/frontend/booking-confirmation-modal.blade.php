<div>
    @if($modal)
    <div class="conform_booking_wp">
        <div class="conform_booking">
            <div class="conform_booking_top">
                <img src="{{ asset('assets/frontend/images/featured-icon.png') }}" alt="featured icon"/>
                <a href="#" wire:click.prevent="closeModal">
                    <svg id="conform_booking_close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 6L6 18M6 6L18 18" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
            <h3 class="conform_booking_heading">@lang('Thank you for booking our moving service')</h3>
            <p class="conform_booking_p1">@lang('Anticipate a call from your movers in few hours')</p>
            <p class="conform_booking_p2">
                <a href="#" class="text-link">Click Here</a>
                to get your invoice sent to your <br> WhatsApp and email &amp; pay link
            </p>
            <a href="#" class="conform_booking_btn">Click Here</a>
            <p class="conform_booking_footer">🔥Do you need a Cleaning service in Finland? <span style="color: #E59735;">Click here</span></p>

        </div>
    </div>
    @endif
</div>

