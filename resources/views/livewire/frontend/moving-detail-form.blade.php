<div class="moving-detail-form">

    <div class="form_heading moving-detail-content">
        <h3 class="form_h_txt moving-detail-title">@lang('Moving Details')</h3>
        <div class="moving-item">
            <div class="form_check_box_input">
                @foreach($this->moving_items() as $index=>$item)
                    <label class="container-checkbox">
                        {{ $item->name }}
                        <input type="checkbox"
                               name="moving_items"
                               id="moving_item_{{ $item->id }}"
                               value="{{ $item->id }}"
                               wire:model="moving_items"
                        />
                        <span class="checkmark"></span>
                    </label>
                @endforeach
            </div>
            @error('moving_items')
                <span class="error error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="input_txt_wp">
            <p class="input_txt_wp_txt">
                @lang('Are there any specific details of your move you’d like us to know? A quick snapshot of your company')
            </p>
            <textarea class="input_txt_wp_input {{ $errors->has('description') ? 'input-error' : '' }}"
                      name="description"
                      id="description"
                      wire:model="description"
                      placeholder="@lang('Please write extra detail if necessary')"
            ></textarea>
        </div>
        @error('description')
        <span class="error error-text">@lang('Please enter detail')</span>
        @enderror
    </div>

    <div class="next_prev_wp">
        <p class="prev" wire:click="goToPrevious"><span>@lang('Previous')</span></p>
        <span class="step">Step 2</span>
        <p class="next" wire:click="storeMovingDetailForm"><span>@lang('Next')</span></p>
    </div>
</div>
