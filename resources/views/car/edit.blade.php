@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Car
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Car</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('cars.update', $car->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        {{-- Aquí es donde mostramos las imágenes existentes --}}
                        <div class="form-group">
                            @if($car->image1)
                                <img src="{{ asset('storage/' . $car->image1) }}" alt="Image 1" style="max-width: 200px;">
                            @endif
                            @if($car->image2)
                                <img src="{{ asset('storage/' . $car->image2) }}" alt="Image 2" style="max-width: 200px;">
                            @endif
                            @if($car->image3)
                                <img src="{{ asset('storage/' . $car->image3) }}" alt="Image 3" style="max-width: 200px;">
                            @endif
                        </div>

                        @include('car.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
