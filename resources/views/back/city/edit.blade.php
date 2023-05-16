@extends('layouts.app')
@section('content')

@include('alerts.alert')

<div class="container pt-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-header justify-content-center">
                <h1>{{__('Edit City')  }}</h1>
            </div>
            <form action="{{route('city-update',$city)}}" method="post" enctype="multipart/form-data">

                <div class="card mt-2">
                    <section class="py-1 text-center container">
                        <div class="col-md-6 mt-3 shadow bg-body-tertiary rounded">
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
                    </section>
                    <div class="row g-0 shadow bg-body-tertiary rounded align-content-center">
                        <div class="col-md-10">
                            <div class="card-body d-flex">
                                <input type="text" class="form-control" name="city_title" value="{{old('city_title',$city->title)}}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="list-table__buttons">
                                    <button type="submit" class="btn btn-primary d-flex align-content-end ms-2" style="width: 80px;" name="save">{{__('Update') }}</button>
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
</div>
@endsection
