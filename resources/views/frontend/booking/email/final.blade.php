<!DOCTYPE html>
<html lang="en" style="font-family: 'Inter', Arial, sans-serif;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Order Summary')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
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
<body style="font-family: 'Inter', Arial, sans-serif; color: #101828; font-size: 15px; line-height: 22px;">
<div style="max-width: 700px; background-color: #fff; border-left: 1px solid #ccc; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc; margin-left: auto; margin-right: auto; font-family: 'Inter', Arial, sans-serif;">
    <div class="top-container" style="background-color: #f8a82a; color: white; padding: 5px 30px; font-family: 'Inter', Arial, sans-serif;">
        <table style="width: 100%; font-family: 'Inter', Arial, sans-serif;">
            <tr>
                <td class="logo-wrapper" style="width: 60px; font-family: 'Inter', Arial, sans-serif;">
                    <a href="{{ getAppUrl() }}" style="font-family: 'Inter', Arial, sans-serif;">
                        <img class="logo-img" src="{{ $message->embed(getInvoiceLogoPath()) }}"
                             style="width: 60px; height:auto; font-family: 'Inter', Arial, sans-serif;"
                             alt="logo"
                        />
                    </a>
                </td>
                <td style="font-family: 'Inter', Arial, sans-serif;">
                    <div style="margin-left: 10px; font-family: 'Inter', Arial, sans-serif;">{{ getAppName() }}</div>
                </td>
                <td style="font-family: 'Inter', Arial, sans-serif;">
                    <div style="text-align: right; font-weight: bold; color: #222; font-family: 'Inter', Arial, sans-serif;">ORDER No. #{{ $booking_id }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container" style="padding: 30px 30px 10px; font-family: 'Inter', Arial, sans-serif;">

        <div style="margin-bottom: 20px; font-family: 'Inter', Arial, sans-serif;">
            <h2 style="text-align: center; margin-top: 0; margin-bottom: 25px; font-family: 'Inter', Arial, sans-serif;">@lang('Order Summary')</h2>
            <div style="font-family: 'Inter', Arial, sans-serif;"><strong style="font-family: 'Inter', Arial, sans-serif;">@lang('Hi :name', ['name' => $name]),</strong></div>
            <div style="font-family: 'Inter', Arial, sans-serif;">@lang('Your order has been placed and confirmed. Please find the details below:')</div>
        </div>

        <div style="font-family: 'Inter', Arial, sans-serif;">
            <h3 style="background-color: #f9f1e7; padding: 10px 20px; margin-bottom: 0; margin-top: 0; font-family: 'Inter', Arial, sans-serif;">@lang('Order Details')</h3>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Name'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">{{ $name }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Email'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">{{ $email }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Phone Number'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">{{ $phone_no }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('WhatsApp Number'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">{{ $whatsapp_no }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Pick Up Locations'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">
                    @foreach($booking->pick_locations as $location)
                        <div style="margin-bottom: 5px; font-family: 'Inter', Arial, sans-serif;">
                            A{{ $loop->index+1 }}. {{ trim($location['address']) }},
                            @lang('Floor'): {{ $location['floor'] }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang("Drop Off Locations"):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">0802 1832 825</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Date Of Move'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">{{ $moving_date }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Time Of Move'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">{{ $moving_time }}</div>
            </div>
            <div class="content-block" style="padding: 10px 20px; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Items To Be Moved'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;"></div>
            </div>
            <div class="content-block" style="padding: 10px 20px; font-family: 'Inter', Arial, sans-serif;">
                <div style="font-weight: bold; margin-bottom: 2px; font-family: 'Inter', Arial, sans-serif;">@lang('Comment'):</div>
                <div style="color: #666; font-family: 'Inter', Arial, sans-serif;">

                </div>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; margin-top: 30px; font-family: 'Inter', Arial, sans-serif;">
            <thead>
            <tr>
                <th class="table-cell" style="padding: 12px 20px; text-align: left; background-color: #f9f1e7; font-weight: bold; font-family: 'Inter', Arial, sans-serif;">Item</th>
                <th class="table-cell" style="padding: 12px 20px; text-align: left; background-color: #f9f1e7; font-weight: bold; font-family: 'Inter', Arial, sans-serif;">Quantity</th>
                <th class="table-cell" style="padding: 12px 20px; text-align: left; background-color: #f9f1e7; font-weight: bold; font-family: 'Inter', Arial, sans-serif;">Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                    <div style="font-family: 'Inter', Arial, sans-serif;">Adiljari Movers - Espo</div>
                    <div style="font-family: 'Inter', Arial, sans-serif;">Services - Small Van + Driver</div>
                </td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">1</td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">£35.00</td>
            </tr>
            <tr>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">
                    <div style="font-family: 'Inter', Arial, sans-serif;">Adiljari Movers - Espo</div>
                    <div style="font-family: 'Inter', Arial, sans-serif;">Services - Small Van + Driver</div>
                </td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">1</td>
                <td class="table-cell" style="padding: 12px 20px; text-align: left; border-bottom: 1px solid #eee; font-family: 'Inter', Arial, sans-serif;">£45.00</td>
            </tr>
            <tr>
                <td></td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left; padding-top: 20px; font-family: 'Inter', Arial, sans-serif;">Sub Total</td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left; padding-top: 20px; font-family: 'Inter', Arial, sans-serif;">£75.00</td>
            </tr>
            <tr>
                <td></td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left; font-family: 'Inter', Arial, sans-serif;">Total</td>
                <td class="table-cell" style="padding: 7px 20px; font-weight: bold; text-align: left; font-family: 'Inter', Arial, sans-serif;">£75.00</td>
            </tr>
            </tbody>
        </table>

        <p>
            <strong class="regard-text" style="font-family: 'Inter', Arial, sans-serif;">Best Regards,</strong>
            <br/>
            <span class="regard-text" style="color: #666; font-family: 'Inter', Arial, sans-serif;">Moving Services Finland</span>
        </p>

        <div style="margin-top: 40px;">
            <p class="footer-text" style="color: #888; line-height: 19px; font-size: 13px; font-family: 'Inter', Arial, sans-serif;">Please note that this e-mail was sent from a notification-only address that can't accept incoming e-mail.
                Please do not reply to this e-mail.</p>
        </div>
    </div>

</div>

</body>
</html>
