<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'city_id', 'image', 'owner_form', 'short_description',
        'infolist', 'contacts', 'availability', 'description',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'infolist' => 'array',
        'contacts' => 'array',
        'availability' => 'array',
    ];


    /**
     * Relation to Services
     *
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'branch_id');
    }



    /**
     * Relation to City
     *
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }



    /**
     * Relation to Company
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }


}
