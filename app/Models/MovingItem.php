<?php

namespace App\Models;


use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MovingItem extends Model
{
    use HasFactory, SortOrder;

    protected $fillable = [
        'name', 'description', 'is_active'
    ];


    /**
     * Active City
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }



}
