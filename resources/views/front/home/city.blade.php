@extends('layouts.app')
@section('content')

<div class="d-flex align-content-center justify-content-center position-absolute top-50 start-50 translate-middle">
    <div class="card" style="max-width: 540px;max-height: 540px">
        <div class="row g-0">
            @foreach ($ovners as $ovner )
            <div class="col-12">
                <div class="card-body align-content-center justify-content-center">

                    <h5 class="card-title text-dark text-center rounded p-3 bg-info text-secondary">Selecte Customer City locate</h5>

                    <p class="card-text">{{$text}}</p>
                    {{-- <img src="{{asset($ovner->photo)}}" class="img-fluid rounded-start" style="width:50%" alt=" bascet"> --}}
                </div>
            </div>
            <div class="col-12">
                <div class="card-body">
                    @include('front.home.common.city')
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
