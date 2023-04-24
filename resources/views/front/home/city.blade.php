@extends('layouts.app')
@inject('city', 'App\Services\CityService')
@section('content')
<div style="background-color:rgb(68,68,68,0.7);position:absoliut;">
    <div class="container mb-5" style="min-height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-header justify-content-between align-content-between d-flex ">
                    <div class="card" style="width: 58rem;">
                        @foreach ($ovners as $ovner )
                        <img src="{{asset($ovner->photo)}}" class="card-img-top" alt="image">
                        @endforeach
                        <div class="card-body">
                            <p class="card-text">{{$text}}</p>
                            <ul class="navbar-nav">
                                @include('front.home.common.city')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
