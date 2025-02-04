<?php

namespace App\Models;


use IbrahimBougaoua\FilamentSortOrder\Traits\SortOrder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, SortOrder;

    protected $fillable = [
        'name', 'image', 'description', 'is_active',
    ];


    /**
     * Active Slider
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }


}
