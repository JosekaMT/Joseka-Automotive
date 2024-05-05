<div class="row py-1 px-1">
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label for="brand" class="form-label">{{ __('Brand') }}</label>
            <input type="text" name="brand" class="form-control border @error('brand') is-invalid @enderror" value="{{ old('brand', $car->brand ?? '') }}" id="brand" placeholder="Brand">
            {!! $errors->first('brand', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4">
            <label for="model" class="form-label">{{ __('Model') }}</label>
            <input type="text" name="model" class="form-control border @error('model') is-invalid @enderror" value="{{ old('model', $car?->model) }}" id="model" placeholder="Model">
            {!! $errors->first('model', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4">
            <label for="body" class="form-label">{{ __('Body') }}</label>
            <select name="body" class="form-select border @error('body') is-invalid @enderror" id="body">
                <option value="" disabled selected>Select Body Type</option>
                <option value="Convertible" {{ old('body', $car?->body) === 'Convertible' ? 'selected' : '' }}>Convertible</option>
                <option value="Coupe" {{ old('body', $car?->body) === 'Coupe' ? 'selected' : '' }}>Coupe</option>
                <option value="Ranchera" {{ old('body', $car?->body) === 'Ranchera' ? 'selected' : '' }}>Ranchera</option>
                <option value="Hatchback" {{ old('body', $car?->body) === 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                <option value="Berlina" {{ old('body', $car?->body) === 'Berlina' ? 'selected' : '' }}>Berlina</option>
                <option value="SUV" {{ old('body', $car?->body) === 'SUV' ? 'selected' : '' }}>SUV</option>
                <option value="MPV" {{ old('body', $car?->body) === 'MPV' ? 'selected' : '' }}>MPV</option>
                <option value="Pickup" {{ old('body', $car?->body) === 'Pickup' ? 'selected' : '' }}>Pickup</option>
            </select>
            {!! $errors->first('body', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
   

        <div class="form-group mb-4">
            <label for="seats" class="form-label">{{ __('Seats') }}</label>
            <input type="text" name="seats" class="form-control border @error('seats') is-invalid @enderror" value="{{ old('seats', $car?->seats) }}" id="seats" placeholder="Seats">
            {!! $errors->first('seats', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>






        <div class="form-group mb-4">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <input type="text" name="description" class="form-control border @error('description') is-invalid @enderror" value="{{ old('description', $car->description ?? '') }}" id="description" placeholder="Description">
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>



        <div class="form-group mb-4">
            <label for="image1" class="form-label">{{ __('Image 1') }}</label>
            <input type="file" name="image1" class="form-control-file border @error('image1') is-invalid @enderror" id="image1">
            {!! $errors->first('image1', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4">
            <label for="image2" class="form-label">{{ __('Image 2') }}</label>
            <input type="file" name="image2" class="form-control-file border @error('image2') is-invalid @enderror" id="image2">
            {!! $errors->first('image2', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4">
            <label for="image3" class="form-label">{{ __('Image 3') }}</label>
            <input type="file" name="image3" class="form-control-file border @error('image3') is-invalid @enderror" id="image3">
            {!! $errors->first('image3', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label for="engine" class="form-label">{{ __('Engine') }} (CC)</label>
            <input type="text" name="engine" class="form-control border @error('engine') is-invalid @enderror" value="{{ old('engine', $car?->engine) }}" id="engine" placeholder="Engine">
            {!! $errors->first('engine', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4">
            <label for="horsepower" class="form-label">{{ __('Horsepower') }} (HP)</label>
            <input type="text" name="horsepower" class="form-control border @error('horsepower') is-invalid @enderror" value="{{ old('horsepower', $car?->horsepower) }}" id="horsepower" placeholder="Horsepower">
            {!! $errors->first('horsepower', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


        <div class="form-group mb-4">
            <label for="fuel" class="form-label">{{ __('Fuel') }}</label>
            <select name="fuel" class="form-select border @error('fuel') is-invalid @enderror" id="fuel">
                <option value="" disabled selected>Select Fuel Type</option>
                <option value="Petrol" {{ old('fuel', $car?->fuel) === 'Petrol' ? 'selected' : '' }}>Petrol</option>
                <option value="Diesel" {{ old('fuel', $car?->fuel) === 'Diesel' ? 'selected' : '' }}>Diesel</option>
            </select>
            {!! $errors->first('fuel', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-4">
            <label for="gears" class="form-label">{{ __('Gears') }}</label>
            <select name="gears" class="form-select border @error('gears') is-invalid @enderror" id="gears">
                <option value="" disabled selected>Select Number of Gears</option>
                <option value="Manual" {{ old('gears', $car?->gears) === 'Manual' ? 'selected' : '' }}>Manual</option>
                <option value="Automatic" {{ old('gears', $car?->gears) === 'Automatic' ? 'selected' : '' }}>Automatic</option>
            </select>
            {!! $errors->first('gears', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>









        <div class="form-group mb-4">
            <label for="color" class="form-label">{{ __('Color') }}</label>
            <select name="color" class="form-select border @error('color') is-invalid @enderror" id="color">
                <option value="" disabled selected>Select Color</option>
                <option value="Red" {{ old('color', $car?->color) === 'Red' ? 'selected' : '' }}>Red</option>
                <option value="Blue" {{ old('color', $car?->color) === 'Blue' ? 'selected' : '' }}>Blue</option>
                <option value="Green" {{ old('color', $car?->color) === 'Green' ? 'selected' : '' }}>Green</option>
                <option value="Yellow" {{ old('color', $car?->color) === 'Yellow' ? 'selected' : '' }}>Yellow</option>
                <option value="Black" {{ old('color', $car?->color) === 'Black' ? 'selected' : '' }}>Black</option>
                <option value="White" {{ old('color', $car?->color) === 'White' ? 'selected' : '' }}>White</option>
                <option value="Silver" {{ old('color', $car?->color) === 'Silver' ? 'selected' : '' }}>Silver</option>
            </select>
            {!! $errors->first('color', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>




        <!-- Adding new properties for 'available' and 'rented' -->
        <div class="form-group mb-4">
            <label for="available" class="form-label">{{ __('Available') }}</label>
            <select name="available" class="form-select border @error('available') is-invalid @enderror" id="available">
                <option value="" disabled selected>Select Availability</option>
                <option value="1" {{ old('available', $car->available ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('available', $car->available ?? '') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('available')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group mb-4">
            <label for="rented" class="form-label">{{ __('Rented') }}</label>
            <select name="rented" class="form-select border @error('rented') is-invalid @enderror" id="rented">
                <option value="" disabled selected>Select Rental Status</option>
                <option value="1" {{ old('rented', $car->rented ?? '') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('rented', $car->rented ?? '') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('rented')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group mb-4">
            <label for="price_per_hour" class="form-label">{{ __('Price Per Hour') }} (€)</label>
            <input type="text" name="price_per_hour" class="form-control border @error('price_per_hour') is-invalid @enderror" value="{{ old('price_per_hour', $car?->price_per_hour) }}" id="price_per_hour" placeholder="Price Per Hour">
            {!! $errors->first('price_per_hour', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
</div>
<div class="row px-3">
    <div class="col-md-12 mt-4">
        <button type="submit" class="btn" style="background-color: #9c2121; color: white;">{{ __('Create') }}</button>
    </div>

</div>