@extends('layouts.app')
@section('content')
@include('alerts.alert')

<div class="container mb-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header justify-content-between align-content-between d-flex ">
                    <h1>{{__('Owner') }}</h1>
                    <a href="{{route('ovner-create')}}" class="btn btn-primary d-flex justify-content-center align-content-center m-2 ">{{__('Add new') }}</a>

                </div>
            </div>
            @forelse($ovners as $ovner)
            <div id="{{$ovner['id'] }}" class="card mt-2 d-flex justify-content-md-between">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-3">
                        <img src="{{asset($ovner->photo)}}" class="img-fluid rounded" alt="imageset">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5><b><i> {{$ovner->title}}</b></i></h5>
                            {{__('Address') }}:
                            <div class="col-md-12 d-flex">
                                <div class="col-md-7">
                                    <h6>{{__('Street') }}: <b><i>{{$ovner->street}}</b></i></h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>{{__('Build') }}: <b><i>{{$ovner->build}}</b></i></h6>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="col-md-7">
                                    <h6>{{__('City') }}: <b><i>{{$ovner->city}}</b></i></h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>{{_('Postcode') }}: <b><i>{{$ovner->postcode}}</b></i></h6>
                   </div>
                            </div>
                            <h6>{{__('Country') }}: <b><i>{{$ovner->country}}</b></i></h6>
                        </div>
                        <div class="card-body">
                            <h6>{{__('Bank') }}: <b><i>{{$ovner->bank}}</b></i></h6>
                            <h6>{{__('Account') }}: <b><i>{{$ovner->account}}</b></i></h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="list-table__buttons">
                            {{-- <a href="{{route('ovner-show', $ovner)}}" class="btn btn-info m-2">{{__('Show') }}</a> --}}
                            <a href="{{route('ovner-edit', $ovner)}}" class="btn btn-secondary m-2" style="width: 80px;">{{__('Edit') }}</a>
                            <form action="{{route('ovner-delete', $ovner)}}" method="post">
                                <button type="submit" class="btn btn-danger m-2">{{__('Delete') }}</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-xxl-12 col-xl-12 col-lg-12">
            <div class="card shadow bg-body-tertiary rounded d-flex ">
                <div class="card-header justify-content-md-between align-items-center d-flex">
                    <h1>{{__('List empty')  }}</h1>
                    <a href="{{route('start')}}" class="btn btn-secondary">{{__('BACK') }}</a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection
