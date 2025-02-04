<?php

namespace App\Libraries\Booking;

use App\Enums\BookingStep;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BookingSession
{
    public static string $bookingSessionKey = 'booking_session';


    /**
     * Initialize Booking Session
     *
     * @return void
     */
    public static function init(): void
    {
        if (!Session::has(self::$bookingSessionKey)) {
            Session::put(self::$bookingSessionKey, self::getBookingData());
        }
    }


    /**
     * Get Booking Session Data
     *
     * @return array
     */
    public static function getBookingData(): array
    {
        return [
            'session_id' => Str::random(30),
            'step' => BookingStep::default(),

            'city_id' => 0,
            'branch_id' => 0,
            'service_id' => 0,
            'services' => [],

            'name' => "",
            'email' => "",
            'phone_no' => "",
            'whatsapp_no' => "",

            "pick_locations" => [['address' => '', 'floor' => '']],
            "drop_locations" => [['address' => '', 'floor' => '']],
            "moving_date" => "",
            "moving_time" => "",

            "moving_items" => [],
            "description" => '',

            "consent" => 0,
            'terms' => 0,
        ];
    }


    /**
     * Update Booking Session Data
     *
     * @param array $data
     * @return void
     */
    public static function update(array $data): void
    {
        $session = self::getSession();

        if (!is_array($session)) {
            return;
        }

        $data = self::getDataForUpdate($session, $data);

        Session::put(self::$bookingSessionKey, $data);
    }

    /**
     * Get Step
     *
     * @return string|int
     */
    public static function getStep(): int|string
    {
        $session = self::getSession();

        if (isset($session['step'])) {
            return $session['step'];
        }

        return BookingStep::default();
    }


    /**
     * Get Session By Key
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        $session = self::getSession();

        if (isset($session[$key])) {
            return $session[$key];
        }

        return null;
    }


    /**
     * Remove Booking Session
     *
     * @return bool
     */
    public static function removeSession(): bool
    {
        return (bool) Session::remove(self::$bookingSessionKey);
    }


    /**
     * Get Booking Session
     *
     * @return array
     */
    public static function getSession(): array
    {
        self::init();

        return Session::get(self::$bookingSessionKey) ?? self::getBookingData(); //?? self::getBookingData()
    }

    /**
     * Get Booking Session
     *
     * @return array
     */
    public static function all(): array
    {
        return self::getSession();
    }


    /**
     * Get Data for Update
     *
     * @param array $session
     * @param array $data
     * @return array
     */
    public static function getDataForUpdate(array $session, array $data): array
    {
        $dataKeys = array_keys($data);

        $updates = [];
        foreach ($session as $key => $value) {
            if (in_array($key, $dataKeys)) {
                $updatedValue = $data[$key];
                $updates[$key] = $updatedValue;
            } else {
                $updates[$key] = $value;
            }
        }
        return $updates;
    }


    public static function goToNext(\Livewire\Component $form, array $update = []): void
    {
        $form->dispatch('go-to-next', $update);
    }



}
