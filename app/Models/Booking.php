<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid', 'name', 'email', 'phone_code', 'phone_no', 'whatsapp_no', 'services', 'total',
        'pick_locations', 'drop_locations', 'moving_date', 'moving_time', 'moving_items', 'description',
        'payment_method',
        'google_sheet', 'sms_sent'
    ];


    public static function fillableProps(): array
    {
        return (new Booking())->getFillable();
    }


    /**
     * cast attributes
     *
     * @var array
     */
    protected $casts = [
        'pick_locations' => 'json',
        'drop_locations' => 'json',
        'moving_items' => 'json',
        'services' => 'json'
    ];

}
