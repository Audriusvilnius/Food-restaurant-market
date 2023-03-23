@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>New Food</h1>
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
                            <h6>Title</h6>
                            <input type="text" class="form-control" name="food_title" value="{{old('food_title')}}">
                            <h6>Price &euro;</h6>
                            <input type="text" class="form-control" name="food_price" value="{{old('food_price')}}">
                            <h6>Restaurant</h6>
                            <select class="form-select" name="restaurant_id">
                                @foreach($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}" @if($restaurant->id == old('restaurant_id')) selected @endif>{{$restaurant->title}}</option>
                                @endforeach
                            </select>
                            {{-- <h6>Restaurant: <b><i>{{$food->restoranFood_name->title}}</b></i></h6> --}}
                            {{-- <input type="text" class="form-control" name="food_rest_id" value="{{old('food_rest_id')}}"> --}}
                            <h6>Additional info</h6>
                            <input type="text" class="form-control" name="food_add" value="{{old('food_add"')}}">
                            <h6>Photo</h6>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="col-md-1">
                            <div class="card-body">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h6>Description</h6>
                                <textarea class="form-control" placeholder="Food description leave a comment here" name="food_des" rows="11" cols="50" value="{{old('food_des')}}"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-danger m-2" style="width: 80px;">Cteate</button>

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
