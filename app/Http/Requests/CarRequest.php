<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'body' => 'required|string|in:Convertible,Coupe,Ranchera,Hatchback,Berlina,SUV,MPV,Pickup', // Type convertido a carroceria con opciones específicas
            'fuel' => 'required|string|in:Petrol,Diesel', // Campo nuevo de combustible
            'gears' => 'required|string|in:Manual,Automatic', // Modificado gears con opciones Manual o Automatico
            'engine' => 'required|numeric', // Engine convertido a cilindrada
            'horsepower' => 'required|numeric', // Horsepower
            'seats' => 'required|numeric|min:1',
            'color' => 'required|string|in:Red,Blue,Green,Yellow,Black,White,Silver', // Añadido campo color con opciones específicas
            'price_per_hour' => 'required|numeric'
        ];
    }
}
