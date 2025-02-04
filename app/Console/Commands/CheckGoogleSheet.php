<?php

namespace App\Console\Commands;

use App\Enums\PaymentMethod;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;
use Revolution\Google\Sheets\Facades\Sheets;


class CheckGoogleSheet extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add booking data to google sheet';


    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $contactNo = 9860357792;
        $contactSheetId = '1cM4zPGomUinJyWru_ULdW-T_CFEb9xsvTdYNI2Gjdqw';
        $contactSheetName = setting('contact_sheet_name');

        if (strlen($contactSheetId) > 0 && strlen($contactSheetName) > 0) {
            try {
                $sheetList = Sheets::spreadsheet($contactSheetId)
                    ->sheetList();

                if (!in_array($contactSheetName, $sheetList)) {
                    Sheets::spreadsheet($contactSheetId)->addSheet($contactSheetName);
                }

                Sheets::spreadsheet($contactSheetId)
                    ->sheet($contactSheetName)
                    ->append([[$contactNo]]);

            } catch (\Exception $exception) {
                throw new \Exception($exception->getMessage());
            }
        } else {
            throw ValidationException::withMessages(['contact_no' => trans('There is some technical issues. Please contact administrator.')]);
        }

    }


    /**
     * Get Booking Services Text
     *
     * @param $services
     * @return array
     */
    protected function getServicesByCityIdAndCompany($services): array
    {
        $array = array();
        /*foreach ($services as $service) {
            $array[$service['city_id']][] = $service;
        }*/
        foreach ($services as $service) {
            $array[$service['city_id']][$service['company_id']][] = $service;
        }
        return $array;
    }

    /**
     * Get Address
     *
     * @param $locations
     * @return string
     */
    protected function getAddress($locations): string
    {
        $text = '';
        $i = 1;
        foreach ($locations as $location) {
            $text .= 'A'.$i++.'. Address=' . $location['address'] . ', '.'Floor='.$location['floor'].PHP_EOL;
        }
        return $text;
    }


    /**
     * Get Moving Items
     *
     * @param $items
     * @return string
     */
    protected function getMovingItems($items): string
    {
        $text = '';
        $i = 1;
        $totalItem = count($items);

        foreach ($items as $item) {
            $text .= $item['name'].($totalItem == $i ? '' : ', ');
            $i++;
        }
        return $text;
    }

    private function getAdminData(mixed $booking): array
    {
        $services = $this->getServicesByCityIdAndCompany($booking->services);
        $pickLocations = $booking->pick_locations;
        $dropLocations = $booking->drop_locations;

        $data = [
            [
                'id' => $booking->id,
                'name' => $booking->name,
                'email' => $booking->email,
                'phone_no' => $booking->phone_no,
                'whatsapp_no' => $booking->whatsapp_no,
                'city' => '',
                'company' => '',
                'service' => '',
                'hours' => '',
                'total' => '',
                'pick' => '',
                'drop' => '',
                'date' => $booking->moving_date,
                'time' => getReadableTime($booking->moving_time),
                'items' => $this->getMovingItems($booking->moving_items),
                'description' => $booking->description,
                'payment_method' => PaymentMethod::getName($booking->payment_method),
            ]
        ];

        $i = 0;
        foreach ($services as $cityId => $cityServices) {

            $j = 0;
            foreach ($cityServices as $companyService) {

                $k = 0;
                foreach ($companyService as $service) {
                    if(!isset($data[$i])) {
                        $data[$i] = [];
                    }
                    $data[$i] = [
                        'id' => $data[$i]['id'] ?? '',
                        'name' => $data[$i]['name'] ?? '',
                        'email' => $data[$i]['email'] ?? '',
                        'phone_no' => $data[$i]['phone_no'] ?? '',
                        'whatsapp_no' => $data[$i]['whatsapp_no'] ?? '',
                        'city' => $j == 0 ? $service['city_name'] : '',
                        'company' => $k == 0 ? $service['company_name'] : '',
                        'service' => $service['service_name'],
                        'hours' => $service['quantity'],
                        'total' => $service['total'],
                        'pick' => '',
                        'drop' => '',
                        'date' => $data[$i]['date'] ?? '',
                        'time' => $data[$i]['time'] ?? '',
                        'items' => $data[$i]['items'] ?? '',
                        'description' => $data[$i]['description'] ?? '',
                        'payment_method' => $data[$i]['payment_method'] ?? '',
                    ];
                    $i++;
                    $j++;
                    $k++;
                }
            }
        }

        foreach ($pickLocations as $index=>$location) {
            if(!isset($data[$index])) {
                $data[$index] = [];
            }

            $data[$index] = [
                'id' => $data[$index]['id'] ?? '',
                'name' => $data[$index]['name'] ?? '',
                'email' => $data[$index]['email'] ?? '',
                'phone_no' => $data[$index]['phone_no'] ?? '',
                'whatsapp_no' => $data[$index]['whatsapp_no'] ?? '',
                'city' => $data[$index]['city'] ?? '',
                'company' => $data[$index]['company'] ?? '',
                'service' => $data[$index]['service'] ?? '',
                'hours' => $data[$index]['hours'] ?? '',
                'total' => $data[$index]['total'] ?? '',
                'pick' => $location['address'].' | floor '.$location['floor'],
                'drop' => '',
                'date' => $data[$index]['date'] ?? '',
                'time' => $data[$index]['time'] ?? '',
                'items' => $data[$index]['items'] ?? '',
                'description' => $data[$index]['description'] ?? '',
                'payment_method' => $data[$index]['payment_method'] ?? '',
            ];
        }

        foreach ($dropLocations as $index=>$location) {
            if(!isset($data[$index])) {
                $data[$index] = [];
            }
            $data[$index] = [
                'id' => $data[$index]['id'] ?? '',
                'name' => $data[$index]['name'] ?? '',
                'email' => $data[$index]['email'] ?? '',
                'phone_no' => $data[$index]['phone_no'] ?? '',
                'whatsapp_no' => $data[$index]['whatsapp_no'] ?? '',
                'city' => $data[$index]['city'] ?? '',
                'company' => $data[$index]['company'] ?? '',
                'service' => $data[$index]['service'] ?? '',
                'hours' => $data[$index]['hours'] ?? '',
                'total' => $data[$index]['total'] ?? '',
                'pick' => $data[$index]['pick'] ?? '',
                'drop' => $location['address'].' | floor '.$location['floor'],
                'date' => $data[$index]['date'] ?? '',
                'time' => $data[$index]['time'] ?? '',
                'items' => $data[$index]['items'] ?? '',
                'description' => $data[$index]['description'] ?? '',
                'payment_method' => $data[$index]['payment_method'] ?? '',
            ];
        }

        $array = [];
        foreach ($data as $datum) {
            $array[] = [
                $datum['id'],
                $datum['name'],
                $datum['email'],
                $datum['phone_no'],
                $datum['whatsapp_no'],
                $datum['city'],
                $datum['company'],
                $datum['service'],
                $datum['hours'],
                $datum['total'],
                $datum['pick'],
                $datum['drop'],
                $datum['date'],
                $datum['time'],
                $datum['items'],
                $datum['description'],
                $datum['payment_method'],
            ];
        }

        return $array;
    }
}
