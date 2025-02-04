<div>

    <div class="total-cart-price-area no-print">
        <div>@lang('Total') <span class="price">{!! showPrice(getCartTotalPrice()) !!}</span></div>
        <a class="cart-icon" wire:click.prevent="openCart">
            <img src="{{ asset('assets/frontend/images/icon-basket.svg') }}" alt="cart icon"/>
            <span class="qty">{{ getCartTotalQuantity() }}</span>
        </a>
    </div>

    @if($modal)
        <?php $total = 0; ?>
        <div class="modal modal-summery">
            <div class="modal-body" wire:clickaway="closeCartModal">
                <div class="cart-modal">
                    <div class="cart-modal-header">
                        <h4 class="cart-modal-title">@lang('Order Summary')</h4>
                        <a class="btn-close" wire:click.prevent="closeCart">
                            <img src="{{ asset('assets/frontend/images/icon-close.svg') }}" alt="close"/>
                        </a>
                    </div>
                    <div class="cart-modal-body">
                        <table class="cart-table">
                            <thead>
                            <tr>
                                <th class="cmt-col-city">@lang('City')</th>
                                <th class="cmt-col-service">@lang('Service')</th>
                                <th class="cmt-col-cost">@lang('Unit Price')</th>
                                <th class="cmt-col-hour">@lang('Quantity')</th>
                                <th class="cmt-col-total">@lang('Total Cost')</th>
                                @if($hasAction)
                                <th style="width: 66px;">@lang("Action")</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="cmt-body">
                            @foreach(getCart() as $item)
                                <tr class="cmt-row">
                                    <td>
                                        <div class="inner-cart-item">
                                            <span class="visible-xs">@lang('City')</span>
                                            <span>{{ $item['city_name'] }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="inner-cart-item">
                                            <span class="visible-xs">@lang('Service')</span>
                                            <span>{{ $item['service_name'] }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="inner-cart-item">
                                            <span class="visible-xs">@lang('Unit Price')</span>
                                            <span>{!! showPrice($item['price']) !!}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="inner-cart-item">
                                            <span class="visible-xs">@lang('Quantity')</span>
                                            <span>{{ $item['quantity'] }} {{ getServiceMeasureType($item['service_type'], $item['quantity']) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="inner-cart-item">
                                            <span class="visible-xs">@lang('Total')</span>
                                            <span class="price">{!! showPrice($item['total']) !!}</span>
                                        </div>
                                    </td>
                                    @if($hasAction)
                                    <td>
                                        <a class="tr-delete"
                                           wire:click.prevent="removeCartItem({{ $item['service_id'] }})"
                                        ><i class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                    @endif
                                </tr>
                                <?php $total += $item['quantity'] * $item['price']; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-footer">
                        <div class="total-price">
                            @lang('Total'):
                            <span class="summery-total-price">{!! showPrice($total) !!}</span>
                        </div>
                        <div>
                            @if(getCartTotalQuantity() > 0)
                                <a class="btn btn-finish-shopping" wire:click.prevent="closeCartAndNext">@lang('Finish shopping')</a>
                            @endif
                            <a class="btn btn-primary" wire:click.prevent="closeCart">@lang('Continue shopping')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
