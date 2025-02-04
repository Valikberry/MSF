<div class="service-selection">

    @include('livewire.frontend.__inc.alert')

    <div class="form_heading">
        <h3 class="form_h_txt">@lang('Where are you booking from?')</h3>

        <div class="select-menu" wire:ignore
             x-data="select2(@entangle('city_id'))"
        >
            <select name="city_id"
                    id="city_id"
                    class="form-control"
                    x-ref="city_id"
                    x-model="selectedCity"
            >
                <option value="0">@lang('Choose Your City')</option>
                @foreach($this->cities as $city)
                    <option {{ $city->id == $city_id ? 'selected' : '' }}
                            value="{{ $city->id }}"
                    >{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="service-listing" id="service-listing">
        <div class="tatal_amount">
            <h3 class="total_h_txt">@lang('Transportation Services and Rates')</h3>
        </div>

        @if($this->services->count() == 0)
            <div class="alert alert-error">@lang('Services are unavailable for this city')</div>
        @endif

        <!-- form card -->
        <div class="form_card_wp">
            @foreach($this->services as $service)
                <div class="form_card" wire:click="selectBranch({{ $service->branch_id }})">
                    <div class="form_card_img_wp" style="position: relative;">
                        <img data-src="{{ getBranchImageUrl($service->branch_image) }}"
                             alt="{{ $service->company_name }}"
                             class="form_card_img lazyload"
                        />
                        <div class="drop-s-thumb">
                            <figure>
                                <img data-src="{{ getCompanyLogoUrl($service->company_logo) }}"
                                     alt="{{ $service->company_name }}"
                                     class="lazyload"
                                />
                            </figure>
                            <span>{{ $service->company_name }}</span>
                        </div>
                    </div>
                    <div class="form_card_txt_wp">
                        <h4 class="form_card_heading product-name">{{ $service->service_name }}</h4>
                        <div class="form_card_price_wp">
                            <p id="per_h_price" class="card-price">{!! showPrice($service->service_price) !!}</p>
                            <p>{{ getPerServiceMeasureType($service->service_type) }}</p>
                        </div>
                    </div>
                    <div class="add_to_cart_wrapper">
                        <button id="add_cart" class="hide">@lang('Add')</button>
                        <div class="add_cart_two">
                            <p id="min">-</p>
                            <span id="item_number">{{ getCartQuantityByServiceId($service->service_id) }}</span>
                            <p id="max">+</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="clearfix pagination-wrap">
            <div class="pull-right">
                {!! $this->services->links() !!}
            </div>
        </div>

    </div>

</div>
