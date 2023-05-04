@inject('city', 'App\Services\CityService')

<form action="{{route('select-city')}}" method="post" class="d-flex">
    <select class="form-select form-select-sm border border-0 bg-dots-darker" name="city_id">
        <option value="{{ null }}" selected>Select City</option>
        @foreach($city->getCity() as $city)
        <option value="{{ $city->id}}" @if($city->id == old('city_id',Session::get('citySelect'))) selected @endif>
            {{$city->title}}
        </option>
        @endforeach
    </select>
    <div class="card-body d-flex">
        <div class="list-table__buttons ms-3">
            <button type="submit" class="btn btn-info">OK</button>
        </div>
    </div>
    @csrf
    @method('post')
</form>
