<div class="payment-form">

    <div class="form_heading payment-content">
        <h3 class="form_h_txt">@lang('Payment Method')</h3>

        <form wire:submit="storePaymentForm">
            <div class="form_payment_system">
                <div class="payment-type">

                    @foreach(\App\Enums\PaymentMethod::all() as $key => $name)
                        <div class="payment_input">
                            <label class="container-checkbox">
                                @if(\App\Enums\PaymentMethod::cash->name == $key)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M7 15H9C9 16.08 10.37 17 12 17C13.63 17 15 16.08 15 15C15 13.9 13.96 13.5 11.76 12.97C9.64 12.44 7 11.78 7 9C7 7.21 8.47 5.69 10.5 5.18V3H13.5V5.18C15.53 5.69 17 7.21 17 9H15C15 7.92 13.63 7 12 7C10.37 7 9 7.92 9 9C9 10.1 10.04 10.5 12.24 11.03C14.36 11.56 17 12.22 17 15C17 16.79 15.53 18.31 13.5 18.82V21H10.5V18.82C8.47 18.31 7 16.79 7 15Z"
                                            fill="black"></path>
                                    </svg>
                                @endif
                                @if(\App\Enums\PaymentMethod::online_payment->name == $key)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4ZM20 18H4V12H20V18ZM20 8H4V6H20V8Z"
                                            fill="black"></path>
                                    </svg>
                                @endif
                                <span class="payment_input_txt">{{ $name }}</span>
                                <input id="{{ $key }}"
                                       type="radio"
                                       wire:model="payment_method"
                                       value="{{ $key }}"
                                />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endforeach

                    @error('payment_method')
                    <span class="error error-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="agree_wp">
                    <div class="agree-item">
                        <label class="container-checkbox">
                            <input id="agree" type="checkbox" wire:model="consent">
                            <span class="checkmark"></span>
                        </label>
                        <a href="{{ setting('consent_page_link') }}" target="_blank" class="agree-item-link">@lang('I hereby consent to providing my information')</a>
                        @error('consent')
                        <div class="error error-text">@lang('Please accept consent')</div>
                        @enderror
                    </div>
                    <div class="agree-item">
                        <label class="container-checkbox">
                            <input id="termsAccept" type="checkbox" wire:model="terms">
                            <span class="checkmark"></span>
                        </label>
                        <a href="{{ setting('terms_page_link') }}" target="_blank" class="agree-item-link">@lang('I Agree to the Terms and Conditions')</a>
                        @error('terms')
                        <div class="error error-text">@lang('Please accept terms and condition')</div>
                        @enderror
                    </div>
                </div>

                <button id="submit_btn"
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="storePaymentForm"
                >
                    <span wire:loading wire:target="storePaymentForm" class="text-loading">@lang('Submitting..')</span>
                    <span wire:loading.remove wire:click="submit" class="text-submit">@lang('Submit')</span>
                </button>
            </div>
        </form>
    </div>

    <div class="next_prev_wp final-step-action">
        <p class="prev" wire:click="goToPrevious"><span>@lang('Previous')</span></p>
    </div>
</div>
