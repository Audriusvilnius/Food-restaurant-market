@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded">
                <div class="card-header">
                    <h1>Ticket</h1>
                </div>
            </div>
            @foreach($order as $ticket)
            <div class="card mt-12 mt-4" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-3">
                        <div class="card-body align-content-center" @if($ticket->status == 0) style="background-color:crimson;border-radius:5px;color:white;" @elseif($ticket->status == 1) style="background-color:skyblue;border-radius:5px;" @elseif($ticket->status == 2) style="background-color:green;border-radius:5px; color:white;" @endif>

                            <h4>Order No.: <b><i>{{$ticket->id}}</b></i></h4>
                            @if($ticket->status == 0)
                            <h5>Order open</h5>
                            @elseif($ticket->status == 1)
                            <h5>Order confirmed</h5>
                            @elseif($ticket->status == 2)
                            <h5>Order complete</h5>
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
                        <div class="card-body" style="background-color:rgba(224, 219, 219, 0.378);;border-radius:5px;">
                            <h5>Total sum.: <b><i>{{$ticket->baskets->total}} &euro;</b></i></h5>


                        </div>
                    </div>
                    <div class="col-md-7">

                    </div>
                    <div class="col-md-1">
                        @if($ticket->status == 2)
                        <div class="card-body d-flex ">
                            <form action="{{route('order-ticket', $ticket)}}" method="post" class="mt-2">
                                <input type="hidden" class="form-control" name="ticket" value="{{$ticket->id}}">
                                <button type="submit" class="btn btn-info m-1">Send</button>
                                @csrf
                                @method('post')
                            </form>
                            @endif
                            <form action="{{route('order-delete', $ticket)}}" method="post" class="mt-2">
                                <button type="submit" class="btn btn-danger m-1">Delete </button>
                                @csrf
                                @method('delete')
                            </form>
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
