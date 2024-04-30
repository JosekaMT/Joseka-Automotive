<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="brand" class="form-label">{{ __('Brand') }}</label>
            <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $car?->brand) }}" id="brand" placeholder="Brand">
            {!! $errors->first('brand', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="model" class="form-label">{{ __('Model') }}</label>
            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model', $car?->model) }}" id="model" placeholder="Model">
            {!! $errors->first('model', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="body" class="form-label">{{ __('Body') }}</label>
            <select name="body" class="form-control @error('body') is-invalid @enderror" id="body">
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
        <div class="form-group mb-2 mb20">
            <label for="fuel" class="form-label">{{ __('Fuel') }}</label>
            <select name="fuel" class="form-control @error('fuel') is-invalid @enderror" id="fuel">
                <option value="" disabled selected>Select Fuel Type</option>
                <option value="Gasolina" {{ old('fuel', $car?->fuel) === 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                <option value="Diesel" {{ old('fuel', $car?->fuel) === 'Diesel' ? 'selected' : '' }}>Diesel</option>
            </select>
            {!! $errors->first('fuel', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="gears" class="form-label">{{ __('Gears') }}</label>
            <select name="gears" class="form-control @error('gears') is-invalid @enderror" id="gears">
                <option value="" disabled selected>Select Number of Gears</option>
                <option value="Manual" {{ old('gears', $car?->gears) === 'Manual' ? 'selected' : '' }}>Manual</option>
                <option value="Automatico" {{ old('gears', $car?->gears) === 'Automatico' ? 'selected' : '' }}>Automatico</option>
            </select>
            {!! $errors->first('gears', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="engine" class="form-label">{{ __('Engine') }}</label>
            <input type="text" name="engine" class="form-control @error('engine') is-invalid @enderror" value="{{ old('engine', $car?->engine) }}" id="engine" placeholder="Engine">
            {!! $errors->first('engine', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="horsepower" class="form-label">{{ __('Horsepower') }}</label>
            <input type="text" name="horsepower" class="form-control @error('horsepower') is-invalid @enderror" value="{{ old('horsepower', $car?->horsepower) }}" id="horsepower" placeholder="Horsepower">
            {!! $errors->first('horsepower', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="seats" class="form-label">{{ __('Seats') }}</label>
            <input type="text" name="seats" class="form-control @error('seats') is-invalid @enderror" value="{{ old('seats', $car?->seats) }}" id="seats" placeholder="Seats">
            {!! $errors->first('seats', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="color" class="form-label">{{ __('Color') }}</label>
            <select name="color" class="form-control @error('color') is-invalid @enderror" id="color">
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
        <!-- Agrega campos de entrada de tipo file para cada imagen -->
        <div class="form-group mb-2 mb20">
            <label for="image1" class="form-label">{{ __('Image 1') }}</label>
            <input type="file" name="image1" class="form-control-file @error('image1') is-invalid @enderror" id="image1">
            {!! $errors->first('image1', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="image2" class="form-label">{{ __('Image 2') }}</label>
            <input type="file" name="image2" class="form-control-file @error('image2') is-invalid @enderror" id="image2">
            {!! $errors->first('image2', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="image3" class="form-label">{{ __('Image 3') }}</label>
            <input type="file" name="image3" class="form-control-file @error('image3') is-invalid @enderror" id="image3">
            {!! $errors->first('image3', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="price_per_hour" class="form-label">{{ __('Price Per Hour') }}</label>
            <input type="text" name="price_per_hour" class="form-control @error('price_per_hour') is-invalid @enderror" value="{{ old('price_per_hour', $car?->price_per_hour) }}" id="price_per_hour" placeholder="Price Per Hour">
            {!! $errors->first('price_per_hour', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>