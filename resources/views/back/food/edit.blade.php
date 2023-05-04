@extends('layouts.app')
@section('content')
@include('alerts.alert')

<div class="container mb-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>{{__('Edit Food')  }}</h1>
                </div>
            </div>

            @include('alerts.alert')

            <form action="{{route('foods-update',$food)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>{{__('Category') }}</h6>
                                <select class="form-select" name="category_id">
                                    @foreach($categories as $category)
                                    @if (app()->getLocale() == "lt")
                                    <option value="{{$category->id}}" @if($category->id == old('category_id',$food->food_category_no)) selected @endif>{{$category->title_lt}}</option>
                                    @else
                                    <option value="{{$category->id}}" @if($category->id == old('category_id',$food->food_category_no)) selected @endif>{{$category->title_en}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <h6>{{__('Title') }}: </h6>
                                @if (app()->getLocale() == "lt")
                                <input type="text" class="form-control" name="food_title_lt" value="{{old('food_title_lt',$food->title_lt)}}">
                                <input type="hidden" name="food_title_en" value="{{$food->title_en}}">


                                @else
                                <input type="text" class="form-control" name="food_title_en" value="{{old('food_title_en',$food->title_en)}}">
                                <input type="hidden" name="food_title_lt" value="{{$food->title_lt}}">


                                @endif
                                <h6>{{__('Price') }}: </h6>
                                <input type="text" class="form-control" name="food_price" value="{{old('food_price',$food->price)}}">
                                <h6>{{__('Restaurant') }}</h6>
                                <select class="form-select" name="restaurant_id">
                                    @foreach($restaurants as $restaurant)
                                    <option value="{{$restaurant->id}}" @if($restaurant->id == old('restaurant_id',$food->rest_id)) selected @endif>{{$restaurant->title}}</option>

                                    @endforeach
                                </select>
                                <h6>{{__('City') }}</h6>
                                <select class="form-select" name="city_id">
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" @if($city->id == old('city_id',$food->food_city_no)) selected @endif>{{$city->title}}</option>
                                    @endforeach
                                </select>


                                {{-- <input type="text" class="form-control" name="food_rest_id" value="{{old('food_rest_id',$food->rest_id)}}"> --}}
                                <h6>{{__('Additional info')  }}: </h6>
                                <input type="text" class="form-control" name="food_add" value="{{old('food_add',$food->add)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6 class="card-title">{{__('Description') }} - LT:</h6>
                                <textarea class="form-control" placeholder="{{__('Food description leave a comment here')  }}" name="food_des_lt" rows="11" cols="30" value="{{old('food_des_lt',$food->des_lt)}}">{{$food->des_lt}}</textarea>
                                <h6 class="card-title">{{__('Description') }} - EN:</h6>
                                <textarea class="form-control" placeholder="{{__('Food description leave a comment here')  }}" name="food_des_en" rows="11" cols="30" value="{{old('food_des_en',$food->des_en)}}">{{$food->des_en}}</textarea>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>{{__('Change Photo')  }}:</h6>
                                <img src="{{asset($food->photo)}}" class="img-fluid rounded" alt="imageset">
                                <input type="file" class="form-control mt-3" name="photo">

                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-danger" name="delete_photo" value="1" onclick="setTimeout()">{{__('Delete photo')  }}</button>
                                    <button type="submit" class="btn btn-primary d-flex align-content-end m-2 " name="save" onclick="setTimeout()">{{__('Update') }}</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('put')
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-4">
        {{-- {{$countrys->links()}} --}}
    </div>
</div>
@endsection
