@inject('countries', 'App\Http\Util\Country')

{{ csrf_field() }}
<div class="form-group">
    <label for="street">
        Street:
    </label>
    <input class="form-control" id="street" name="street" type="text" value="{{ old('street')}}">
    </input>
</div>
<div class="form-group">
    <label for="city">
        City:
    </label>
    <input class="form-control" id="city" name="city" type="text" value="{{ old('city')}}">
    </input>
</div>
<div class="form-group">
    <label for="zip">
        Zip/Postal Code:
    </label>
    <input class="form-control" id="zip" name="zip" type="text" value="{{ old('zip')}}">
    </input>
</div>
<div class="form-group">
    <label for="country">
        Country:
    </label>
    <select class="form-control" id="country" name="country">
        @foreach ($countries::all() as $country=>$code)
        <option value="{{ $code }}">
            {{ $country }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="state">
        State:
    </label>
    <input class="form-control" id="state" name="state" type="text" value="{{ old('state')}}">
    </input>
</div>
<div class="form-group">
    <label for="price">
        Price
    </label>
    <input class="form-control" id="price" name="price" type="text" value="{{ old('price')}}">
    </input>
</div>
<div class="form-group">
    <label for="description">
        Home Description:
    </label>
    <textarea class="form-control" id="description" name="description" rows="8">
        {{ old('description') }}
    </textarea>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">
        Create Flyer
    </button>
</div>
