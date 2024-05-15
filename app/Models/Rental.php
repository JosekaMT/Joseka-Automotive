<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Si deseas incluir eliminación suave

class Rental extends Model
{
    use HasFactory;
    // use SoftDeletes; // Eliminar 

    /**
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'brand',
        'model',
        'image1',
    ];

    /**
     *
     * @var array<string>
     */
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    /**
     * Obtener el usuario que realizó el alquiler.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el coche alquilado.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Configuraciones para soft deletes.
     */
    protected $softDelete = true;
}
