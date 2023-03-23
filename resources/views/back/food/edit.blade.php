@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>Edit Food</h1>
                </div>
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded d-flex justify-content-md-between">

                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            <form action="{{route('foods-update',$food)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Title: </h6>
                                <input type="text" class="form-control" name="food_title" value="{{old('food_title',$food->title)}}">
                                <h6>Price: </h6>
                                <input type="text" class="form-control" name="food_price" value="{{old('food_price',$food->price)}}">
                                <h6>Restaurant</h6>
                                <select class="form-select" name="restaurant_id">
                                    @foreach($restaurants as $restaurant)
                                    <option value="{{$restaurant->id}}" @if($restaurant->id == old('restaurant_id')) selected @endif>{{$restaurant->title}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" name="food_rest_id" value="{{old('food_rest_id',$food->rest_id)}}"> --}}
                                <h6>Additional info: </h6>
                                <input type="text" class="form-control" name="food_add" value="{{old('food_add',$food->add)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6 class="card-title">Description:</h6>
                                <textarea class="form-control" placeholder="Food description leave a comment here" name="food_des" rows="11" cols="30" value="{{old('food_des',$food->des)}}">{{$food->des}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Photo change:</h6>
                                <img src="{{asset($food->photo)}}" class="img-fluid rounded" alt="imageset">
                                <input type="file" class="form-control mt-3" name="photo">
                            </div>
                            {{-- <div class=" card-body">
                                <div class="list-table__buttons">
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-12 ">
                            <div class="card-body">
                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-danger" name="delete_photo" value="1">Delete photo</button>
                                    <button type="submit" class="btn btn-primary d-flex align-content-end m-2 " style="width: 80px;" name="save">Update</button>



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
