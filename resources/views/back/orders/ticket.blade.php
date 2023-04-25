@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 900px">

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow bg-body-tertiary rounded">
                <div class="card-header">
                    <h1>On the way</h1>
                </div>
            </div>
            @foreach($order as $ticket)
            <div class="card mt-12 mt-4" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-3">
                        <div class="card-body align-content-center" @if($ticket->status == 0) style="background-color:crimson;border-radius:5px;color:white;" @elseif($ticket->status == 1) style="background-color:skyblue;border-radius:5px;" @elseif($ticket->status == 2)
                            style="background-color:skyblue;border-radius:5px;" @elseif($ticket->status == 3) style="background-color:rgba(224, 219, 219, 0.378);border-radius:5px;" @endif>
                            <h4>Order No.: <b><i>{{$order->id}}</b></i></h4>
                            <h6>{{$order->created_at}} - {{$order->created_at}}</h6>
                            @if($order->status == 0)
                            <p>Open</p>
                            @elseif($order->status == 1)
                            <h5>Processing</h5>
                            @elseif($order->status == 2)
                            <h5>Ready to ship</h5>
                            @elseif($order->status == 3)
                            <p>Completed</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="card-body align-content-center">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body align-content-center">
                            <h6>User name: <b><i>{{$ticket->user->name}}</b></i></h6>
                            <h6>User ID: <b><i>{{$ticket->user->id}}</b></i></h6>
                        </div>
                    </div>
                    @foreach ($ticket->baskets->baskets as $food)
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
                    {{-- <div class="col-md-8">
                    </div> --}}
                    <div class="col-md-3">
                        <div class="card-body" style="background-color:rgba(224, 219, 219, 0.378);border-radius:5px;">
                            <h5>Total sum.: <b><i>{{$ticket->baskets->total}} &euro;</b></i></h5>
                        </div>
                    </div>

                    <div class="col-md-9 d-flex align-content-end ">
                        <div class="card-body">

                            <form action="{{route('order-ticket', $ticket)}}" method="post" class="mt-2">
                                <input type="hidden" class="form-control" name="ticket" value="{{$ticket->id}}">
                                <button type="submit" class="btn btn-info float-end">On the way</button>
                                @csrf
                                @method('post')
                            </form>
                        </div>
                        {{-- @endif --}}
                        {{-- <form action="{{route('order-delete', $ticket)}}" method="post" class="mt-2">
                        <button type="submit" class="btn btn-danger float-end">Delete </button>
                        @csrf
                        @method('delete')
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="mt-4">
    {{-- {{$countrys->links()}} --}}
</div>
</div>


@endsection
