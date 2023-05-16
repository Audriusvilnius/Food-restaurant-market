@extends('layouts.app')
@section('content')
@include('alerts.alert')

<div class="container pt-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-header justify-content-center">
                <h1>{{__('Create City')  }}</h1>
            </div>
            @include('alerts.alert')
            <form action="{{route('city-create')}}" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="row g-0 shadow bg-body-tertiary rounded align-content-center">
                        <div class="col-md-10">
                            <div class="card-body d-flex">
                                <input type="text" class="form-control" name="city_title" value="{{old('city_title',)}}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="list-table__buttons">
                                    <button type="submit" class="btn btn-primary d-flex align-content-end ms-2" name="save">{{__('Create') }}</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('post')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
