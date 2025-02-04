<div class="location-form">

    <div class="form_heading moving-address">

        <h3 class="form_h_txt moving-address-title">@lang('Moving Address')</h3>


        <div class="form_two_input">
            <div class="pickup_fields">

                @foreach($pick_locations as $key=>$pick_location)
                    <div class="field-location-item">
                        @if($key > 0)
                            <a class="btn-close-input-wp" wire:click="removePickupLocation({{$key}})"><i
                                    class="fa-solid fa-xmark"></i></a>
                        @endif
                        <div class="input_wp">
                            <label for="name" class="label">@lang('Pick-up Location') (A{{$key + 1}})</label>
                            <input type="text"
                                   class="input_field {{ $isUpdated && strlen($pick_location['address']) == 0 ? 'input-error' : '' }}"
                                   wire:model="pick_locations.{{ $key }}.address"
                                   placeholder="{{ trans('Enter Your Address Line Here') }}"
                                   wire:keydown.enter="storeLocationForm"
                            />
                            @if($isUpdated && strlen($pick_location['address']) == 0)
                                <div class="error error-text">@lang('Pick-up address is required')</div>
                            @endif
                        </div>
                        <div class="input_wp">
                            <label for="name" class="label">@lang('Floor Level') (A{{$key + 1}})</label>
                            <input type="text"
                                   id="name"
                                   class="input_field {{ $isUpdated && strlen($pick_location['floor']) == 0 ? 'input-error' : '' }}"
                                   wire:model="pick_locations.{{ $key }}.floor"
                                   placeholder="{{ trans('Enter Your Floor Level') }}"
                                   wire:keydown.enter="storeLocationForm"
                            />
                            @if($isUpdated && strlen($pick_location['floor']) == 0)
                                <div class="error error-text">@lang('Pick-up floor is required')</div>
                            @endif
                        </div>

                    </div>
                @endforeach

                <!-- pick up add -->
                <div class="pick_up_wp" id="add_more_loc"
                     wire:click="addPickupLocation"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10.0003 4.1665V15.8332M4.16699 9.99984H15.8337" stroke="var(--fc47)"
                              stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <p class="pick_up_txt">@lang('Add More pick-up location')</p>
                </div>

            </div>

            <div class="dropoff_fields">
                @foreach($drop_locations as $key=>$drop_location)
                    <div class="field-location-item">
                        @if($key > 0)
                            <a class="btn-close-input-wp" wire:click="removeDropoffLocation({{$key}})"><i
                                    class="fa-solid fa-xmark"></i></a>
                        @endif
                        <div class="input_wp">
                            <label for="name" class="label">@lang('Drop-off Location') (B{{$key + 1}})</label>
                            <input type="text"
                                   class="input_field {{ $isUpdated && strlen($drop_location['address']) == 0 ? 'input-error' : '' }}"
                                   wire:model="drop_locations.{{ $key }}.address"
                                   placeholder="{{ trans('Enter Your Address Line Here') }}"
                                   wire:keydown.enter="storeLocationForm"
                            />
                            @if($isUpdated && strlen($drop_location['address']) == 0)
                                <div class="error error-text">@lang('Drop-off address is required')</div>
                            @endif
                        </div>
                        <div class="input_wp">
                            <label for="name" class="label">@lang('Floor Level') (B{{$key + 1}})</label>
                            <input type="text"
                                   id="name"
                                   class="input_field {{ $isUpdated && strlen($drop_location['floor']) == 0 ? 'input-error' : '' }}"
                                   wire:model="drop_locations.{{ $key }}.floor"
                                   placeholder="{{ trans('Enter Your Floor Level') }}"
                                   wire:keydown.enter="storeLocationForm"
                            />
                            @if($isUpdated && strlen($drop_location['floor']) == 0)
                                <div class="error error-text">@lang('Drop-off floor is required')</div>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="pick_up_wp" id="add_more_drop"
                     wire:click="addDropoffLocation"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10.0003 4.1665V15.8332M4.16699 9.99984H15.8337" stroke="var(--fc47)"
                              stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <p class="pick_up_txt">@lang('Add More drop-off location')</p>
                </div>
            </div>

            <div class="input_wp">
                <div class="booking-date"
                     wire:ignore
                     x-data="datepicker(@entangle('moving_date'))"
                >
                    <div class="timepicker-wrap">
                        <label for="datepicker" class="label">@lang('Date Of Move')</label>
                        <div class="datepicker-group">
                            <input type="text"
                                   id="datepicker"
                                   class="input_field"
                                   placeholder="@lang('Select Date')"
                                   x-ref="datepicker"
                                   x-model="selectedDate"
                            />
                            <span class="datepicker-close" x-on:click="resetDate">
                                     <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                          viewBox="0 0 24 24"
                                          fill="none">
                                        <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                        </div>

                    </div>
                </div>
                @if($errors->has('moving_date'))
                    <div class="error error-text">@lang('Date is required')</div>
                @endif
            </div>

            <div class="input_wp">
                <div class="booking-time">
                    <div class="timepicker-wrap">
                        <label for="timepicker" class="label">@lang('Time Of Move')</label>
                        <select name="timepicker"
                                id="timepicker"
                                class="input_field"
                                wire:model="moving_time"
                        >
                            @foreach(config('admin.service_times') as $value => $time)
                                <option value="{{ $value }}">{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($errors->has('moving_time'))
                    <div class="error error-text">@lang('Time is required')</div>
                @endif
            </div>

        </div>
    </div>

    <div class="next_prev_wp">
        <p class="prev" wire:click="goToPrevious"><span>@lang('Previous')</span></p>
        <p class="next" wire:click="storeLocationForm"><span>@lang('Next')</span></p>
    </div>
</div>
</div>
