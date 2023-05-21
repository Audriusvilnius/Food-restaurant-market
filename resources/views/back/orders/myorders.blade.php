@inject('basket', 'App\Services\BasketService')
@extends('layouts.app')
@section('content')
<div class="container pt-5 pb-5" style="min-height: 900px">
    <div class=" row justify-content-center">
        <div class="col-md-6">
            <div class="card-header align-items-center justify-content-center d-flex">
                <h1>{{__('My Orders')  }}</h1>
            </div>
            @include('alerts.alert')
            @forelse($orders as $order)
            <div id="{{ $order['id'] }}" class="card mt-12 mt-4" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-12">
                        <div class="card-body align-content-center" @if($order->status == 0) style="background-color:crimson;border-radius:5px;color:white;" @elseif($order->status == 1) style="background-color:skyblue;border-radius:5px;" @elseif($order->status == 2)
                            style="background-color:grey;border-radius:5px;" @elseif($order->status == 3)
                            style="background-color:rgba(224, 219, 219, 0.378);border-radius:5px;" @endif>
                            <h4>{{__('Order No.')  }}: <b><i>{{$order->id}}</b></i></h4>
                            <span class="mb-2">{{__('Opened') }} - {{$order->created_at}}</h6>
                                <h4>{{__('Order status')  }}:</h4>
                                @if($order->status == 0)
                                <h5>{{__('Order open')  }}</h5>
                                @elseif($order->status == 1)
                                <h5>{{__('Processing') }}</h5>
                                @elseif($order->status == 2)
                                <h5>{{__('Ready to ship')  }}</h5>
                                @elseif($order->status == 3)
                                <h5>{{__('Order complete')  }}</h5>
                                @endif
                                - {{$order->created_at}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body align-content-center">
                            @foreach ($order->baskets->baskets as $food)
                            {{__('Restaurant') }}: <b>{{$food->rest_title}}</b>
                            <div class="col-md-12">
                                {{__('Title') }}: <b><i>
                                        @if (app()->getLocale() == "lt")
                                        {{$food->title_lt}}
                                        @else
                                        {{$food->title_en}}
                                        @endif
                                </b></i><br>
                                <div class="d-flex justify-content-end">
                                    {{__('Price') }}: <b><i>{{$food->price}} &euro;</b></i>
                                    {{__('Qty') }}: <b><i>{{$food->count}}</b></i>
                                    {{__('Sum') }}: <b><i>{{$food->price*$food->count}} &euro;</b></i>
                                    {{__('Delivery Fee')  }}: <b class="text-success"><i>{{$basket->delivery($food)}} </i></b><br>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="card-body" style="background-color:rgba(224, 219, 219, 0.378);;border-radius:5px;">
                                <h5>{{__('Total sum')  }}: <b class="text-success"><i>{{$order->baskets->total}} &euro;</b></i></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="card-body align-items-center justify-content-center d-flex">
                    <a href="{{route('start')}}" class="btn btn-secondary mt-3">{{__('HOME') }}</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
