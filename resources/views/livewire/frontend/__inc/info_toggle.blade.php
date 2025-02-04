<div class="contact-item">
    <div>
        @if(strlen($type) > 0)
            @if($type == \App\Enums\ContactType::phone->name)
                <img src="{{ asset('assets/frontend/images/phone.png') }}" alt="phone-number"/>
            @endif

            @if($type == \App\Enums\ContactType::website->name)
                <img src="{{ asset('assets/frontend/images/solar_global-bold.png') }}" alt="website"/>
            @endif

            @if($type == \App\Enums\ContactType::address->name)
                <img src="{{ asset('assets/frontend/images/solar_home-2-bold.png') }}" alt="address"/>
            @endif
        @endif

        @if($hide)
            <span>{{ \Illuminate\Support\Str::limit($text, 8, 'xxxxxxxx') }}</span>
        @else
            <span>{{ $text }}</span>
        @endif
    </div>
    <div>
        <a href="#" wire:click.prevent="toggle">
            <img src="{{ asset('assets/frontend/images/icon-eye.svg') }}"
                 alt="visible-detail"
            />
        </a>
    </div>
</div>
