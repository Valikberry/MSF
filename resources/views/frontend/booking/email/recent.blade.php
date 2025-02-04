<!DOCTYPE html>
<html lang="en" style="font-family: 'Inter', Arial, sans-serif;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Order Summary')</title>
    <style>
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: local('Inter Regular'), local('Inter-Regular'),
                 url('{{ asset('fonts/inter/Inter-Regular.woff2') }}') format('woff2');
        }
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            src: local('Inter Bold'), local('Inter-Bold'), url('{{ asset('fonts/inter/Inter-Bold.woff2') }}') format('woff2');
        }
        body, * {
            font-family: 'Inter', Arial, sans-serif;
        }
        @media only screen and (max-width: 600px) {
            body {
                font-size: 13px !important;
                line-height: 19px !important;
            }
            .container {
                padding: 24px 15px 8px !important;
            }
            .top-container {
                padding: 10px 15px 6px !important;
            }
            h2 {
                margin-bottom: 20px !important;
            }
            h3 {
                padding: 8px 16px !important;
            }
            .content-block {
                padding: 8px 16px !important;
            }
            .table-cell {
                padding: 9.6px 16px !important;
            }
            .regard-text {
                font-size: 13px !important;
                line-height: 19px !important;
            }
            .footer-text {
                font-size: 11px !important;
            }
            .logo-wrapper {
                width: 30px !important;
            }
            .logo-img {
                width: 30px !important;
            }
        }
    </style>
</head>
<body style="color: #101828; font-size: 15px; line-height: 22px;">
<div style="max-width: 700px; background-color: #fff; border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc; margin-left: auto; margin-right: auto;">
    <div class="top-container" style="background-color: #f8a82a; color: white; padding: 5px 30px;">
        <table style="width: 100%;">
            <tr>
                <td class="logo-wrapper" style="width: 60px;">
                    <a href="{{ getAppUrl() }}">
                        <img class="logo-img" src="{{ $message->embed(getInvoiceLogoPath()) }}"
                             style="width: 60px; height:auto;"
                             alt="logo"
                        />
                    </a>
                </td>
                <td>
                    <div style="margin-left: 10px;">{{ getAppName() }}</div>
                </td>
                <td>
                    <div style="text-align: right; font-weight: bold; color: #222;">ORDER No. #{{ $booking_id }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container" style="padding: 30px 30px 10px;">

        <div style="margin-bottom: 20px;">
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 25px;">@lang('Order Summary')</h2>
            <div><strong>@lang('Hi :name', ['name' => $name]),</strong></div>
            <div>@lang('Your order has been placed and confirmed. Please find the details below:')</div>
        </div>

        <div>
            <h3 style="background-color: #f9f1e7; padding: 10px 20px; margin-bottom: 0; margin-top: 0;">@lang('Order Details')</h3>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Name'):</div>
                <div style="color: #666;">{{ $name }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Email'):</div>
                <div style="color: #666;">{{ $email }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Phone Number'):</div>
                <div style="color: #666;">{{ $phone_no }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('WhatsApp Number'):</div>
                <div style="color: #666;">{{ $whatsapp_no }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Pick Up Locations'):</div>
                <div style="color: #666;">
                    @foreach($booking->pick_locations as $location)
                        <div style="margin-bottom: 5px;">
                            A{{ $loop->index+1 }}. {{ trim($location['address']) }},
                            @lang('Floor'): {{ $location['floor'] }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang("Drop Off Locations"):</div>
                <div style="color: #666;"></div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Date Of Move'):</div>
                <div style="color: #666;">{{ $moving_date }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Time Of Move'):</div>
                <div style="color: #666;">{{ $moving_time }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Items To Be Moved'):</div>
                <div style="color: #666;"></div>
            </div>
            <div class="content-block" style="padding: 10px 20px;">
                <div style="font-weight: bold; margin-bottom: 2px;">@lang('Comment'):</div>
                <div style="color: #666;">

                </div>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; margin-top: 30px;">
            <thead>
            <tr>
                <th class="table-cell" style="padding: 12px 20px; text-align: left; background-color: #f9f1e7; font-weight: bold;">Item</th>
                <th class="table-cell" style="padding: 12px 20px; text-align: left; background-color: #f9f1e7; font-weight: bold;">Quantity</th>
                <th class="table-cell" style="padding: 12px 20px; text-align: left; background-color: #f9f1e7; font-weight: bold;">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee;">
                    <div>Adiljari Movers - Espo</div>
                    <div>Services - Small Van + Driver</div>
                </td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee;">1</td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee;">£35.00</td>
            </tr>
            <tr>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee;">
                    <div>Adiljari Movers - Espo</div>
                    <div>Services - Small Van + Driver</div>
                </td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee;">1</td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee;">£45.00</td>
            </tr>
            <tr>
                <td></td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left; padding-top: 20px;">Sub Total</td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left; padding-top: 20px;">£75.00</td>
            </tr>
            <tr>
                <td></td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left;">Total</td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left;">£75.00</td>
            </tr>
            </tbody>
        </table>

        <p>
            <strong class="regard-text">Best Regards,</strong>
            <br/>
            <span class="regard-text" style="color: #666;">Moving Services Finland</span>
        </p>

        <div style="margin-top: 40px;">
            <p class="footer-text" style="color: #888; line-height: 19px; font-size: 13px;">Please note that this e-mail was sent from a notification-only address that can't accept incoming e-mail.
                Please do not reply to this e-mail.</p>
        </div>
    </div>

</div>

</body>
</html>
