@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>Add new Restaurants</h1>
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

            <form action="{{route('restaurants-store')}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Restaurants title</h6>
                                <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title')}}">
                                <h6>City</h6>
                                <input type="text" class="form-control" name="restaurant_city" value="{{old('restaurant_city')}}">
                                <h6>Addres</h6>
                                <input type="text" class="form-control" name="restaurant_addres" value="{{old('restaurant_addres')}}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card-body">
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-5">
                                        <h6>Open</h6>
                                        <input type="time" class="form-control" name="restaurant_open" value="{{old('restaurant_open')}}" min="0" max="24">

                                    </div>
                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-5">
                                        <h6>Close</h6>
                                        <input type="time" class="form-control" name="restaurant_close" value="{{old('restaurant_close')}}" min="0" max="24">
                                    </div>
                                </div>
                                <h6 class="card-title text-muted">Phone:</h6>
                                <input type="text" class="form-control" name="restaurant_add" value="{{old('restaurant_phone')}}">
                                <h6>Photo</h6>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card-body">
                                <h6>Description:</h6>
                                <textarea class="form-control" placeholder="Restaurant description leave a comment here" name="restaurant_des" rows="6" cols="130" value="{{old('restaurant_des')}}"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-danger" style="width: 80px;">Cteate</button>

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
<hr class=" border border-second border-0 opacity-50 m-5">
<hr class=" border border-second border-0 opacity-50 m-5">
@endsection
