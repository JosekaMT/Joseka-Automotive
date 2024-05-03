<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 *
 * @property $id
 * @property $brand
 * @property $model
 * @property $body
 * @property $fuel
 * @property $gears
 * @property $engine
 * @property $horsepower
 * @property $seats
 * @property $color
 * @property $price_per_hour
 * @property $available
 * @property $rented
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Car extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand',
        'model',
        'body',
        'fuel',
        'gears',
        'engine',
        'horsepower',
        'seats',
        'color',
        'price_per_hour',
        'available', 
        'rented' 
    ];
}
