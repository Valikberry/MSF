<div class="service-selection">

    @include('livewire.frontend.__inc.alert')

    <div class="back-previous-page">
        <a href="{{ route('booking.home', ['city' => $citySlug]) }}" class="back-link">
            <img src="{{ asset('assets/frontend/images/icon-back.png') }}"
                alt="back-btn"
                class="back-icon"
            />
            <span>@lang('Back')</span>
        </a>
        <span><span class="divider">/</span> {{ $this->branch->company_name }}</span>
    </div>

    <div class="service-title">
        <figure class="service-title-figure">
            <img src="{{ getCompanyLogoUrl($this->branch->logo) }}" alt="avatar"/>
        </figure>
        <div class="service-title-info">
            <h3>{{ $this->branch->company_name }}</h3>
            <span class="service-rating">
                <img src="{{ asset('assets/frontend/images/icon-star.svg') }}" alt="star icon"/>
                {{ $this->branch->rating }} @lang('stars')
            </span>
            <span class="service-review">
                {{ $this->branch->reviews }} @lang('reviews')
            </span>
            <span class="service-name">
                {{ $this->branch->main_service }}
            </span>
        </div>

        <figure class="verification-label {{ $this->branch->verified ? 'verified' : '' }}">
            @if($this->branch->verified)
                <img src="{{ asset('assets/frontend/images/icon-verified.svg') }}" alt="verified-icon"/>
                <span class="verification-text">@lang('Verified')</span>
            @else
                <img src="{{ asset('assets/frontend/images/icon-unverified.svg') }}" alt="unverified-icon"/>
                <span class="verification-text">@lang('Unverified')</span>
            @endif
        </figure>
    </div>

    <div class="service-detail">

        <div class="service-display">
            <div class="service-display--left row">
                <div class="col-sm-5">
                    <div class="service-thumb">
                        <figure>
                            <img src="{{ getBranchImageUrl($this->branch->image) }}"
                                 alt=""
                                 class="img-responsive"
                            />
                        </figure>
                    </div>
                    <div class="text-wrapper">
                        <div class="confirm-text">
                            <img src="{{ asset('assets/frontend/images/user-Icon.svg') }}" alt="person-icon"/>
                            <p>
                                <a href="{{ $this->branch->owner_link }}"
                                   target="_blank"
                                   class="confirm-link"
                                >
                                    @lang('Are You The Owner Of This Page?')
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="service-desc">
                        <p class="sdesc">{!! $this->branch->short_description !!}</p>
                        <div class="service-specification">
                            <p class="service-info">@lang('Info & Details')</p>
                            <div class="service-list">
                                @foreach($this->branch->infolist as $info)
                                    <div class="service-item">
                                        <p class="info-title">{{ $info['label'] }}</p>
                                        <p>{!! nl2br($info['value']) !!}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="service-action-btn">
                            <a href="#"
                               class="btn btn-green"
                               wire:click.prevent="openServiceModal"
                            >@lang('Book Service')</a>
                            <a href="#"
                               class="btn btn-outline-primary"
                               wire:click.prevent="openContactModal"
                            >@lang('Contact Us')</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

            <div class="service-pricing--wrapper">
                <p class="wrapper-title" >@lang('Services & Pricing Details')</p>
                <div class="price-list row">
                    @foreach($this->branch->services as $service)
                    <div class="col-md-4">
                        <a href="#"
                           class="price-item-link"
                           wire:click.prevent="openServiceModal"
                        >
                            <div class="price-item">
                                <div class="info-title">{!! showPrice($service->price) !!}</div>
                                <span>{{ $service->name }}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        <div class="service-schedule">
            <div class="row">
                <div class="col-sm-5">
                    <div class="contact-availablity">
                        <p class="wrapper-title">@lang('Contact Methods')</p>
                        @foreach($this->branch->contacts as $index => $contact)
                            <div class="contact-item">
                                <div class="contact-details">
                                    @if(isset($contact['type']))
                                        @if($contact['type'] == \App\Enums\ContactType::phone->name)
                                            <img src="{{ asset('assets/frontend/images/icon-phone.svg') }}" alt="phone-number"/>
                                        @endif

                                        @if($contact['type'] == \App\Enums\ContactType::website->name)
                                            <img src="{{ asset('assets/frontend/images/icon-website.svg') }}" alt="website"/>
                                        @endif

                                        @if($contact['type'] == \App\Enums\ContactType::address->name)
                                            <img src="{{ asset('assets/frontend/images/icon-address.svg') }}" alt="address"/>
                                        @endif
                                    @endif

                                    @if(!in_array($index, $hideContacts))
                                        <span>{{ \Illuminate\Support\Str::limit($contact['value'] ?? '', 8, 'xxxxxxxx') }}</span>
                                    @else
                                        <span>{{ $contact['value'] ?? '' }}</span>
                                    @endif
                                </div>
                                <div>
                                    <a href="#" wire:click.prevent="toggleContacts({{ $index }})">
                                        <img src="{{ asset('assets/frontend/images/icon-visible.svg') }}"
                                             alt="visible-detail"
                                        />
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="contact-availablity">
                        <p class="wrapper-title">@lang('Availability')</p>
                        @foreach($this->branch->availability as $time)
                            <div class="service-item ">
                                <p>{{ $time['day'] }}</p>
                                <p>{{ $time['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="announcement">
            <div class="announcement-header">@lang('Announcements')</div>
            <div class="announcement-desc">
                {!! $this->branch->description !!}
            </div>
        </div>

        <div class="service-bottom">
            <div class="rate-service">
                <div class="sb-icon"><img src="{{ asset('assets/frontend/images/rating-icon.svg') }}" alt="rating"></div>
                <span class="sb-action-text">@lang('Rate This Service')</span>
            </div>
            <div class="review-service">
                <div class="sb-icon"><img src="{{ asset('assets/frontend/images/icon_review.svg') }}" alt="review"></div>
                <span class="sb-action-text">@lang('Write A Review')</span>
            </div>
            <div class="report-service">
                <div class="sb-icon"><img src="{{ asset('assets/frontend/images/icon_report.svg') }}" alt="report"></div>
                <span class="sb-action-text">@lang('Report Issue')</span>
            </div>
        </div>
    </div>


    @if($serviceModal)
        <div class="pop_up_card_wp service-modal">
            <div class="pop_up_card service-popup" wire:clickaway="closeServiceModal">
                <div class="service-popup-header">
                    <div class="service-title service-title-sm">
                        <figure class="service-title-figure">
                            <img src="{{ getCompanyLogoUrl($this->branch->logo) }}" alt="avatar">
                        </figure>
                        <div class="service-title-info">
                            <h3>{{ $this->branch->company_name }}</h3>
                            <span class="service-rating">
                            <img src="{{ asset('assets/frontend/images/icon-star.svg') }}" alt="star icon"/>
                            {{ $this->branch->rating }} @lang('stars')
                        </span>
                            <span class="service-review">{{ $this->branch->reviews }} @lang('reviews')</span>
                            <span class="service-name">{{ $this->branch->main_service }}</span>
                        </div>
                    </div>
                    <div class="btn-close" wire:click="closeServiceModal">
                        <img src="{{ asset('assets/frontend/images/icon-close.svg') }}" alt="close"/>
                    </div>
                </div>

                <div class="popup-service-table">
                    <div class="pst-header">
                        <div class="pst-row">
                            <div class="pst-col pst-name">
                                @lang('Service')
                            </div>
                            <div class="pst-col pst-cost">
                                @lang('Cost')
                            </div>
                            <div class="pst-col pst-quantity">
                                @lang('Quantity')
                            </div>
                        </div>
                    </div>
                    <div class="pst-body">
                       <?php $total = 0; ?>
                        @foreach($this->branch->services as $service)
                        <div class="pst-row">
                            <div class="pst-col pst-name">{{ $service->name }}</div>
                            <div class="pst-col pst-cost">
                                {!! showPrice($service->price) !!} {{ getPerServiceMeasureType($service->type) }}
                            </div>
                            <div class="pst-col pst-quantity">
                                <div class="pop_up_card_numbers">
                                    <p class="min inc-quantity" wire:click="decreaseQuantity({{ $service->id }})">-</p>
                                    <span type="number" class="pop_num item-qty text-center">{{ getQuantityFromExistingServices($this->services, $service->id) }}</span>
                                    <p class="max dec-quantity" wire:click="increaseQuantity({{ $service->id }})">+</p>
                                </div>
                            </div>
                        </div>
                        <?php $total += getQuantityFromExistingServices($this->services, $service->id) * $service->price; ?>
                        @endforeach
                    </div>
                    <div class="pst-actions">
                        <h4 class="pop_up_card_amount_h">
                            @lang('Total'): <span class="card-total-price">{!! showPrice($total) !!}</span>
                        </h4>
                        <div class="pst-action-btn">
                            <button class="add_btn_pop_up"
                                    wire:click="addToCart"
                            >@lang('Add to cart')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($contactModal)
        <div class="pop_up_card_wp contact-modal">
            <div class="pop_up_card service-popup" wire:clickaway="closeContactModal">
                <div class="contact-modal-header">
                    <h4 class="contact-modal-title">@lang('Contact Us')</h4>
                    <a class="btn-close" wire:click.prevent="closeContactModal">
                        <img src="{{ asset('assets/frontend/images/icon-close.svg') }}" alt="close"/>
                    </a>
                </div>

                <div class="contact-modal-body">
                    @if (session()->has('contact_updated'))
                        <div class="alert alert-success mb-30">
                            {{ session('contact_updated') }}
                        </div>
                    @endif

                    <div class="row cmb-item" wire:ignore>
                        <div class="col cmb-item-left">
                            @lang('Give Us A Call')
                        </div>
                        <div class="col cmb-item-right">
                            <span>+1 828 8219 3121</span>
                            <a id="copyButton" title="+1 828 8219 3121" class="copy-text"
                               @click="
                                    const textField = document.createElement('input');
                                    textField.value = '+1 828 8219 3121';
                                    document.body.appendChild(textField);
                                    textField.select();
                                    try {
                                        document.execCommand('copy');
                                    } catch (err) {
                                        alert('Failed to copy text!');
                                    }
                                    document.body.removeChild(textField);
                                "
                            >
                                <img src="{{ asset('assets/frontend/images/icon-copy.svg') }}" alt="copy"/>
                            </a>
                        </div>
                    </div>
                    <div class="row cmb-item">
                        <div class="col cmb-item-left">
                            @lang('Text Us On Whatsapp')
                        </div>
                        <div class="col cmb-item-right">
                            <a href="https://wa.me/182882193121"
                               target="_blank"
                               class="whatsapp-img"
                            >
                                <img src="{{ asset('assets/frontend/images/icon-whatsapp.svg') }}" alt="whatsapp"/>
                            </a>
                        </div>
                    </div>

                    <div class="cmb-actions">
                        <div class="cmb-or">
                            - @lang('OR') -
                        </div>
                        <div class="cmb-input-group">
                            <input type="text"
                                   wire:model="contact_no"
                                   class="custom-input {{ $errors->has('contact_no') ? 'input-error' : '' }}"
                                   placeholder="@lang('Enter Phone Number')"
                            />
                            @error('contact_no')
                            <span class="error error-text">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="cmb-action-btn">
                            <button class="btn btn-primary btn-block"
                                    wire:click="addToContactSheet"
                            >@lang('Request A Call-back')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="next_prev_wp">
        <a href="{{ route('booking.home', ['city' => $citySlug]) }}" class="prev"><span>@lang('Previous')</span></a>
        @if(getCartTotalQuantity() > 0)
            <p class="next" wire:click="goToContactForm"><span>@lang('Next')</span></p>
        @endif
    </div>
</div>

