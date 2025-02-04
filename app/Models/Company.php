<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'logo', 'main_service', 'rating', 'reviews', 'company_doc', 'verified'];


    protected $casts = [
        'verified' => 'boolean',
    ];

    /**
     * Active Company
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }


    /**
     * Relation to Branch
     *
     * @return HasMany
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'company_id');
    }


    /**
     * Relation to Service
     *
     * @return HasManyThrough
     */
    public function services(): HasManyThrough
    {
        return $this->hasManyThrough(Service::class, Branch::class, 'company_id', 'branch_id', 'id', 'id');
    }


}
