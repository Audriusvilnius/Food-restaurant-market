@inject('city', 'App\Services\CityService')
<form action="{{route('select-city')}}" method="post" class="d-flex">
    <select class="form-select border border-0 bg-dots-darker" name="city_id">
        @foreach($city->getCity() as $city)
        <option value="{{$city->id}}" @if($city->id == old('city_id')) selected @endif>{{$city->title}}</option>
        @endforeach
    </select>
    <div class="card-body d-flex">
        <div class="list-table__buttons ">
            <button type="submit" class="btn btn-danger m-2 rounded-5">OK</button>
        </div>
    </div>
    @csrf
    @method('post')
</form>
