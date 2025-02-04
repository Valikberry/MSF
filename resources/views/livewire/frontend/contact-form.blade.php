<div class="contact-form">


    <div class="form_heading personal-info">
        <h3 class="form_h_txt">@lang('Personal Information')</h3>
        <!-- input field -->
        <div class="form_two_input">
            <!-- input -->
            <div class="input_wp">
                <label for="name" class="label">@lang('First Name')</label>
                <input type="text"
                       id="name"
                       class="input_field {{ $errors->has('name') ? 'input-error' : '' }}"
                       placeholder="@lang('Enter First Name')"
                       wire:model="name"
                       wire:keydown.enter="storeContactForm"
                />
                @error('name')
                <span class="error error-text">{{ $message }}</span>
                @enderror
            </div>
            <!-- input -->
            <div class="input_wp">
                <label for="email" class="label">@lang('Email')</label>
                <input type="email"
                       id="email"
                       class="input_field {{ $errors->has('email') ? 'input-error' : '' }}"
                       placeholder="@lang('Enter Email Address')"
                       wire:model="email"
                       wire:keydown.enter="storeContactForm"
                />
                @error('email')
                <span class="error error-text">{{ $message }}</span>
                @enderror
            </div>
            <!-- input -->
            <div class="input_wp">
                <label for="phone_code" class="label">@lang('Phone Number')</label>
                <div class="phone_wp input-group">
                    <div class="phone-code-group">
                        <div class="country-flag">{!! setting('country_flag') !!}</div>
                        <div class="phone-code">{{ setting('phone_code') }}</div>
                    </div>
                    <div>
                        <input type="text"
                               id="name"
                               class="input_field {{ $errors->has('phone_no') ? 'input-error' : '' }}"
                               wire:model="phone_no"
                               placeholder="@lang('Enter Phone Number')"
                               wire:keydown.enter="storeContactForm"
                        />
                    </div>
                </div>
                @error('phone_no')
                    <span class="error error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="input_wp">
                <label for="whatsapp_no" class="label">@lang('WhatsApp Number')</label>
                <input type="text"
                       id="whatsapp_no"
                       class="input_field {{ $errors->has('whatsapp_no') ? 'input-error' : '' }}"
                       wire:model="whatsapp_no"
                       placeholder="@lang('Enter Whatsapp Number')"
                       wire:keydown.enter="storeContactForm"
                />
                @error('whatsapp_no')
                    <span class="error error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="next_prev_wp">
        <a class="prev" href="{{ url()->previous() != route('booking.process') ? url()->previous() : route('booking.home') }}"><span>@lang('Previous')</span></a>
        <p class="next" wire:click="storeContactForm"><span>@lang('Next')</span></p>
    </div>
</div>
