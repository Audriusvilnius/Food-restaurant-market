@extends('layouts.app')

@section('content')
<div class="container mb-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card">
                    <div class="card-header justify-content-between align-content-between d-flex ">
                        <h1>{{__('New Food') }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            @if($errors)
            @foreach ($errors->all() as $message)
            <h6 class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </h6>
            @endforeach
            @endif

            <form action="{{route('foods-store')}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-3">
                            <h6>{{__('Title') }} - LT</h6>
                            <input type="text" class="form-control" name="food_title_lt" value="{{old('food_title_lt')}}">
                            <h6>{{__('Title') }} - EN</h6>
                            <input type="text" class="form-control" name="food_title_en" value="{{old('food_title_en')}}">
                            <h6>{{__('Price') }} &euro;</h6>
                            <input type="text" class="form-control" name="food_price" value="{{old('food_price')}}">
                            <h6>{{__('Restaurant') }}</h6>
                            <select class="form-select" name="restaurant_id">
                                @foreach($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}" @if($restaurant->id == old('restaurant_id')) selected @endif>{{$restaurant->title}}</option>
                                @endforeach
                            </select>
                            <h6>{{__('City') }}</h6>
                            <select class="form-select" name="city_id">
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" @if($city->id == old('city_id')) selected @endif>{{$city->title}}</option>
                                @endforeach
                            </select>
                            <h6>{{__('Category') }}</h6>
                            @if (app()->getLocale() == "lt")
                            <select class="form-select" name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>{{$category->title_lt}}</option>
                                @endforeach
                            </select>
                            @else
                            <select class="form-select" name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>{{$category->title_en}}</option>
                                @endforeach
                            </select>
                            @endif
                            {{-- <h6>Restaurant: <b><i>{{$food->restoranFood_name->title}}</b></i></h6> --}}
                            {{-- <input type="text" class="form-control" name="food_rest_id" value="{{old('food_rest_id')}}"> --}}
                            <h6>{{__('Additional info')  }}</h6>
                            <input type="text" class="form-control" name="food_add" value="{{old('food_add"')}}">
                            <h6>{{__('Photo') }}</h6>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="col-md-1">
                            <div class="card-body">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h6>{{__('Description') }} - LT</h6>
                                <textarea class="form-control" placeholder="{{__('Food description leave a comment here')  }}" name="food_des" rows="9" cols="50" value="{{old('food_des_lt')}}"></textarea>
                                <h6>{{__('Description') }} - EN</h6>
                                <textarea class="form-control" placeholder="{{__('Food description leave a comment here')  }}" name="food_des" rows="9" cols="50" value="{{old('food_des_en')}}"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="list-table__buttons ">
                                    <a href="{{route('city-create')}}" class="btn btn-primary m-2 float-end">{{__('Add City') }}</a>
                                    <a href="{{route('category-create')}}" class="btn btn-primary d-flex justify-content-end align-content-center m-2 ">{{__('Add Category') }}</a>
                                    <a href="{{route('restaurants-store')}}" class="btn btn-primary d-flex justify-content-center align-content-center m-2 ">{{__('Add Restaurant') }}</a>

                                    <button type="submit" class="btn btn-danger m-2">{{__('Create') }}</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                    @method('post')
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
