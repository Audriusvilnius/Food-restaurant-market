@inject('city', 'App\Services\CityService')

<form action="{{route('select-city')}}" method="post" class="d-flex">
    <select class="form-select" name="city_id">
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





{{-- <section class="d-flex js--form">
    <select class="form-select" name="city_id">
        @foreach($cities as $city)
        <option value="{{$city->id}}" selected>{{$city->title}}</option>
@endforeach
</select>
<div class="card-body d-flex">
    <div class="list-table__buttons ">
        <button type="button" class="btn btn-danger m-2 rounded-5">OK</button>
    </div>
</div>
</section> --}}
