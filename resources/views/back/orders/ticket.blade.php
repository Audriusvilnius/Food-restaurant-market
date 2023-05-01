@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 900px">

    <div class=" row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow bg-body-tertiary rounded ">
                <div class="card-header">
                    <h1>Shipped</h1>
                </div>
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            @foreach($orders as $order)
            @if($order->status == 3)

            <div id="{{ $order['id'] }}" class="card mt-12 mt-4" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-6">
                        <div class="card-body align-content-center" @if($order->status == 0) style="background-color:crimson;border-radius:5px;color:white;" @elseif($order->status == 1) style="background-color:skyblue;border-radius:5px;" @elseif($order->status == 2)
                            style="background-color:grey;border-radius:5px;" @elseif($order->status == 3)
                            style="background-color:rgba(224, 219, 219, 0.378);border-radius:5px;" @endif>
                            <h4>Order No.: <b><i>{{$order->id}}</b></i></h4>
                            @if($order->status == 0)
                            <h5>Open
                                @elseif($order->status == 1)
                                <h5>Processing
                                    @elseif($order->status == 2)
                                    <h5>Ready to ship
                                        @elseif($order->status == 3)
                                        <h5>Shipped
                                            @endif
                                            - {{$order->updated_at}}</h5>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="card-body align-content-center">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-body align-content-center">
                            <h6>User name: <b><i>{{$order->user->name}}</b></i></h6>
                            <h6>User ID: <b><i>{{$order->user->id}}</b></i></h6>
                            <h6 class="mb-2">Open - {{$order->created_at}}</h6>
                        </div>
                    </div>
                    @foreach ($order->baskets->baskets as $food)
                    <div class="col-md-2">
                        <div class="card-body align-content-center">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <hr class="border border-1 opacity-50">
                        Title: <b><i>{{$food->title}}</b></i>,
                        <p> price : <b><i>{{$food->price}} &euro;</b></i>
                            qty: <b><i>{{$food->count}}</b></i>
                            Sum: <b><i>{{$food->price*$food->count}} &euro;</b></i></p>
                    </div>
                    @endforeach

                    <div class="col-md-3">
                        <div class="card-body" style="background-color:rgba(224, 219, 219, 0.378);;border-radius:5px;">
                            <h5>Total sum.: <b><i>{{$order->baskets->total}} &euro;</b></i></h5>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                    </div> --}}
                    <div class="col-md-9 d-flex align-content-end">
                        <div class="card-body">
                            @if($order->status == 0)
                            <form action="{{route('order-update', $order)}}" method="post">
                                <button type="submit" class="btn btn-danger float-end uppercase">Processing</button>

                                @csrf
                                @method('put')
                            </form>
                            @endif
                            @if($order->status == 1)
                            <form action="{{route('order-update', $order)}}" method="post">

                                <button type="submit" class="btn btn-warning float-end uppercase">Complete</button>

                                @csrf
                                @method('put')

                            </form>
                            @endif
                            @if($order->status == 2)
                            <form action="{{route('order-status', $order)}}" method="post">
                                <input type="hidden" class="form-control" name="ticket" value="{{$order->id}}">
                                <button type="submit" class="btn btn-success float-end uppercase">To shep</button>

                                @csrf
                                @method('post')
                            </form>
                            @endif
                            @if($order->status == 3) <form action="{{route('order-delete', $order)}}" method="post">
                                <button type="submit" class="btn btn-danger float-end uppercase" @if($order->status !=3)disabled @endif>Delete</button>

                                @csrf
                                @method('delete')
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div>@endif

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
