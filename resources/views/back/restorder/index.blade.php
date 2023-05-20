@extends('layouts.app')
@section('content')
<div class="container pt-5 pb-5" style="min-height: 900px">
    <div class=" row justify-content-center">
        <div class="col-md-9">
            <div class="card-header align-items-center justify-content-center d-flex">
                <h1>{{__('All Orders')  }}: {{Auth::user()->name }}</h1>
            </div>
            @include('alerts.alert')
            @forelse($restOrder as $order)
            <div id="{{ $order['id'] }}" class="card mt-12 mt-4" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-6">
                        <div class="card-body align-content-center" @if($order->status == 0) style="background-color:crimson;border-radius:5px;color:white;" @elseif($order->status == 1) style="background-color:skyblue;border-radius:5px;" @elseif($order->status == 2)
                            style="background-color:grey;border-radius:5px;" @elseif($order->status == 3)
                            style="background-color:rgba(224, 219, 219, 0.378);border-radius:5px;" @endif>
                            <h4>{{__('Order No.')  }}: <b><i>{{$order->order_id}}</b></i></h4>
                            <h6 class="mb-2">{{__('Open') }} - {{$order->created_at}}</h6>
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
                            <h6>{{__('User ID')  }}: <b><i>{{$order->user_id}}</b></i></h6>
                            <h6>{{__('Name') }}: <b><i>{{$order->user_rest_Order->name}}</b></i></h6>
                            <h6>{{__('City') }}: <b><i>{{$order->city}}</b></i></h6>
                            <h6>{{__('Street') }}: <b><i>{{$order->user_rest_Order->street}}</b></i> {{__('Build') }}: <b><i>{{$order->user_rest_Order->build}}</b></i></h6>
                            <h6>{{__('Email') }}: <b><i>{{$order->user_rest_Order->email}}</b></i></h6>
                            <h6>{{__('Phone') }}: <b><i>{{$order->user_rest_Order->phone}}</b></i></h6>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card-body align-content-center">
                            <h6><b>{{$order->rest_Order_rest->title}}</b></h6>
                            <h6>{{__('City') }}: <b><i>{{$order->rest_Order_City->title}}</b></i></h6>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <hr class="border border-1 opacity-50">
                        {{__('Menu No') }}.:<b><i>{{$order->food_id}}</b></i><br>
                        {{__('Title') }}: <b><i>
                                @if (app()->getLocale() == "lt")
                                {{$order->rest_Order_food->title_lt}}
                                @else
                                {{$order->rest_Order_food->title_en}}
                                @endif
                        </b></i>
                        <p>{{__('price') }}: <b><i>{{$order->rest_Order_food->price}} &euro;</b></i>
                            {{__('qty') }}: <b><i>{{$order->qty}}</b></i>
                            {{__('Sum') }}: <b><i>{{$order->rest_Order_food->price*$order->qty}} &euro;</b></i></p>
                    </div>
                    <div class="col-md-3">
                        {{-- <div class="card-body" style="background-color:rgba(224, 219, 219, 0.378);;border-radius:5px;">
                            <h5>{{__('Total sum.')  }}: <b><i>{{$order->baskets->total}} &euro;</b></i></h5>
                    </div> --}}
                </div>
                <div class="col-md-9 d-flex align-content-end">
                    <div class="card-body">
                        @if($order->status == 0)
                        <form action="{{route('restorder-update', $order)}}" method="post">
                            <input type="hidden" class="form-control" name="order_id" value="{{$order->order_id}}">
                            <button type="submit" class="btn btn-danger float-end">{{__('Processing') }}</button>
                            @csrf
                            @method('put')
                        </form>
                        @endif
                        @if($order->status == 1)
                        <form action="{{route('restorder-update', $order)}}" method="post">
                            <input type="hidden" class="form-control" name="order_id" value="{{$order->order_id}}">
                            <button type="submit" class="btn btn-warning float-end">{{__('Complete') }}</button>
                            @csrf
                            @method('put')
                        </form>
                        @endif
                        @if($order->status == 2)
                        <form action="{{route('restorder-status', $order)}}" method="post">
                            <input type="hidden" class="form-control" name="order_id" value="{{$order->order_id}}">
                            <button type="submit" class="btn btn-success float-end">{{__('To ship')  }}</button>
                            @csrf
                            @method('post')
                        </form>
                        @endif
                        @if($order->status == 3) <form action="{{route('restorder-delete', $order)}}" method="post">
                            <button type="submit" class="btn btn-danger float-end" @if($order->status !=3)disabled @endif>{{__('Delete') }}</button>
                            @csrf
                            @method('delete')
                        </form>
                        @endif
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
@endsection
