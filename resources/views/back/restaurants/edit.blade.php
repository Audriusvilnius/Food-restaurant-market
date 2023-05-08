@extends('layouts.app')

@section('content')
<div class="container mb-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>{{__('Restaurants edit')  }}</h1>
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
            <form action="{{route('restaurants-update',$restaurant)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded ">
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>{{__('Title') }}:</h6>
                                <input type="text" class="form-control" name="restaurant_title" value="{{old('restaurant_title',$restaurant->title)}}">
                                <h6>{{__('City') }}:</h6>
                                <h6>{{__('Address') }}:</h6>
                                <input type="text" class="form-control" name="restaurant_addres" value="{{old('restaurant_addres',$restaurant->addres)}}">
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-4">
                                        <h6>{{__('Open') }}:</h6>
                                        <input type="time" class="form-control" name="restaurant_open" value="{{old('restaurant_open',$restaurant->open)}}" min="0" max="24">
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-4">
                                        <h6>{{__('Close') }}: </h6>
                                        <input type="time" class="form-control " name="restaurant_close" value="{{old('restaurant_close',$restaurant->close)}}" min="0" max="24">
                                    </div>
                                </div>
                                <h6 class="card-title text-muted">{{__('Phone') }}:</h6>
                                <input type="text" class="form-control" name="restaurant_phone" value="{{old('restaurant_phone',$restaurant->phone)}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>{{__('Description') }}</h6>
                                <textarea class="form-control" name="restaurant_des" rows="12" cols="130" value="{{old('restaurant_des',$restaurant->des)}}" placeholder="{{__('Leave a Comment here')  }}">{{$restaurant->des}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>{{__('Change Photo')  }}:</h6>
                                <div class="position-relative">
                                    <button type="submit" class="btn btn-sm position-absolute top-0 start-100 translate-middle " name="delete_photo" value="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle bg-danger rounded-5" viewbox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                        </svg>
                                    </button>

                                    <img src="{{asset($restaurant->photo)}}" class="img-fluid rounded" alt="imageset">
                                </div>
                                <input type="file" class="form-control mt-4" name="photo">
                                <div class="list-table__buttons ">
                                    <button type="submit" class="btn btn-primary d-flex align-content-end mt-2">{{__('Update') }}</button>
                                </div>
                                @csrf
                                @method('put')
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
