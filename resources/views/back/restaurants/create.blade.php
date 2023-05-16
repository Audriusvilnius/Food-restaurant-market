@extends('layouts.app')
@section('content')
<div class="container pt-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card">
                    <div class="card-header justify-content-between align-content-between d-flex ">
                        <h1>{{__('Add new Restaurant')  }}</h1>
                        <a href="{{route('city-create')}}" class="btn btn-primary d-flex justify-content-center align-content-center m-2 ">{{__('Add City') }}</a>
                    </div>
                </div>
            </div>

            @include('alerts.alert')

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
                                <h6>{{__("Restaurant's title")  }}</h6>
                                <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title')}}">
                                {{-- <h6>{{__('City') }}</h6>
                                <input type="text" class="form-control" name="restaurant_city" value="{{old('restaurant_city')}}"> --}}
                                <h6>{{__('Address') }}</h6>
                                <input type="text" class="form-control" name="restaurant_addres" value="{{old('restaurant_addres')}}">
                                <h6 class="card-title text-muted">{{__('Phone') }}:</h6>
                                <input type="text" class="form-control" name="restaurant_phone" value="{{old('restaurant_phone')}}">
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card-body">
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-5">
                                        <h6>{{__('Open') }}</h6>
                                        <input type="time" class="form-control" name="restaurant_open" value="{{old('restaurant_open')}}" min="0" max="24">
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-5">
                                        <h6>{{__('Close') }}</h6>
                                        <input type="time" class="form-control" name="restaurant_close" value="{{old('restaurant_close')}}" min="0" max="24">
                                    </div>
                                </div>
                                <h6>{{__('Photo') }}</h6>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card-body">
                                <h6>{{__('Description') }}:</h6>
                                <textarea class="form-control" placeholder="{{__('Leave a comment here')  }}" name="restaurant_des" rows="7" cols="130" value="{{old('restaurant_des')}}"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-danger">{{__('Create') }}</button>
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
</div>

@endsection
