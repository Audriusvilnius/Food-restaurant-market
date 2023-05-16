@inject('basket', 'App\Services\BasketService')
@extends('layouts.app')
@section('content')
<div class="container pt-5 pb-5" style="min-height: 900px">
    <div class=" row justify-content-center">
        <div class="col-md-9">
            <div class="card-header">
                <h1>{{__('My Orders')  }}</h1>
            </div>
            @include('alerts.alert')
            @foreach($orders as $order)
            <div id="{{ $order['id'] }}" class="card mt-12 mt-4" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-6">
                        <div class="card-body align-content-center" @if($order->status == 0) style="background-color:crimson;border-radius:5px;color:white;" @elseif($order->status == 1) style="background-color:skyblue;border-radius:5px;" @elseif($order->status == 2)
                            style="background-color:grey;border-radius:5px;" @elseif($order->status == 3)
                            style="background-color:rgba(224, 219, 219, 0.378);border-radius:5px;" @endif>
                            <h4>{{__('Order No.')  }}: <b><i>{{$order->id}}</b></i></h4>
                            <h6 class="mb-2">{{__('Opened') }} - {{$order->created_at}}</h6>
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
                    <div class="col-md-1">
                        <div class="card-body align-content-center">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-body align-content-center">
                            @foreach ($order->baskets->baskets as $food)
                            <div class="col-md-2">
                                <div class="card-body align-content-center">
                                </div>
                            </div>
                            <div class="col-md-10">

                                {{__('Title') }}: <b><i>
                                        @if (app()->getLocale() == "lt")
                                        {{$food->title_lt}}
                                        @else
                                        {{$food->title_en}}
                                        @endif
                                </b></i>

                                <p>{{__('Price') }}: <b><i>{{$food->price}} &euro;</b></i><br>
                                    {{__('Qty') }}: <b><i>{{$food->count}}</b></i><br>
                                    {{__('Sum') }}: <b><i>{{$food->price*$food->count}} &euro;</b></i></p>
                                <h6>{{__('Delivery Fee')  }}: <b class="text-success"><i>{{$basket->delivery($food)}} </i></b></h6>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body" style="background-color:rgba(224, 219, 219, 0.378);;border-radius:5px;">
                            <h5>{{__('Total sum')  }}: <b class="text-success"><i>{{$order->baskets->total}} &euro;</b></i></h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
