@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>Restaurants edit</h1>
                </div>
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('not'))
                <h6 class=" alert alert-danger alert-dismissible fade show" role="alert">{{Session::get('not')}}
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


            <form action="{{route('restaurants-update',$restaurant)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded ">
                        {{--
                        <div class="col-md-3">
                            <div class="card-body">
                            </div>
                        </div> --}}
                        {{-- sekciaj padalinta i dvus pradzia--}}
                        <div class="col-md-4">
                            <div class="card-body">

                                <h6>Title:</h6>
                                <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title',$restaurant->title)}}">

                                <h6>City:</h6>
                                <input type="text" class="form-control" name="restaurant_city" value="{{old('restaurant_city',$restaurant->city)}}">

                                <h6>Addres:</h6>
                                <input type="text" class="form-control" name="restaurant_addres" value="{{old('restaurant_addres',$restaurant->addres)}}">
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-4">
                                        <h6>Open:</h6>
                                        <input type="time" class="form-control" name="restaurant_open" value="{{old('restaurant_open',$restaurant->open)}}" min="0" max="24">
                                    </div>
                                    <div class="col-md-1">
                                    </div>

                                    <div class="col-md-4">
                                        <h6>Close: </h6>
                                        <input type="time" class="form-control " name="restaurant_close" value="{{old('restaurant_close',$restaurant->close)}}" min="0" max="24">
                                    </div>
                                </div>
                                <h6 class="card-title text-muted">Phone:</h6>
                                <input type="text" class="form-control" name="add" value="{{old('restaurant_add',$restaurant->phone)}}">
                            </div>
                        </div>
                        {{-- sekciaj padalinta i dvus pabaiga--}}

                        {{-- <div class="col-md-3">
                            <div class="card-body">
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Description</h6>
                                <textarea class="form-control" name="restaurant_des" rows="12" cols="130" value="{{old('restaurant_des',$restaurant->des)}}" placeholder="Restaurant description leave a comment here">{{$restaurant->des}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Photo change:</h6>
                                {{-- <h6>Restaurant id: <b><i>{{$restaurant->id}}</b></i></h6> --}}
                                <img src="{{asset($restaurant->photo)}}" class="img-fluid rounded" alt="imageset">
                                <input type="file" class="form-control mt-4" name="photo">

                                {{-- <div class=" card-body">
                                <div class="list-table__buttons">
                                </div>
                            </div> --}}

                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-danger" name="delete_photo" value="1">Delete photo</button>
                                    <button type="submit" class="btn btn-primary d-flex align-content-end m-2" style="width: 80px;">Update</button>

                                </div>
                                @csrf
                                @method('put')
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
