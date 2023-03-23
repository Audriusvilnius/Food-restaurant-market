@inject('basket', 'App\Services\BasketService')
@extends('layouts.front')
@section('content')

<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up">
        <i class="bi bi-arrow-left"></i>
    </div>
</a>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($basketList->count())
            <div class="card">
                <div class="card-header justify-content-center">
                    <h1>Delivery date and time</h1>
                </div>
            </div>
            <section class="py-1 text-center container">
                <div class="col-lg-4 col-md-8 mx-auto mt-1 py-2">
                    @if(Session::has('ok'))
                    <h6 class=" alert alert-success alert-dismissible fade show border border-dark border-2" role="alert">{{Session::get('ok')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                    @endif
                </div>
            </section>
            @endif
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('not'))
                <h6 class=" alert alert-danger alert-dismissible fade show" role="alert">{{Session::get('not')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            {{-- <form action="{{route('make-order')}}" method="post"> --}}

            @forelse($basketList as $food)
            <div class="card mt-2 d-flex justify-content-md-between">
                <div id="{{$food['id'] }}" class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-1 d-flex align-items-center justify-content-md-between">
                        <div class="card-body">
                            <input class="form-check-input" type="checkbox" value="{{$food->id}}" id="flexCheckChecked" checked>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <img src="{{asset($food->photo)}}" class="img-fluid rounded" alt="imageset">
                    </div>

                    <div class="col-md-2">
                        <div class="card-body">
                            <h5><b><i>{{$food->title}}</b></i></h5>
                            <div class="card-body">
                                <h6>Price: <b><i>{{$food->price}} &euro;</b></i></h6>
                                <h6>Qty: <b><i>{{$food->count}}</b></i></h6>
                            </div>
                            <h6>Sum: <b><i>{{$food->count*$food->price}} &euro;</b></i></h6>
                        </div>
                    </div>

                    {{-- sekciaj padalinta i dvus pradzia--}}
                    <div class="col-md-3 d-flex">
                        <div class="col-md-12 ">
                            {{-- <div class="card-body">
                                    <h6>Restaurant: <b><i>{{$food->foodReataurants_name->title}}</b></i></h6>
                            <div class="col-md-12 d-flex">
                                <div class="col-md-6">
                                    <h6>Open: <b><i>{{$food->foodReataurants_name->open}}</b></i></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>Close: <b><i>{{$food->foodReataurants_name->close}}</b></i></h6>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-12 d-flex">
                            <div class="card-body">
                                Delivery date
                                <input type="date" class="form-control" name="date" value="{{$date}}" min="{{ $date }}">


                                <input type="hidden" class="form-control" name="id" value="{{$food->id}}">
                            </div>
                        </div>
                        <div class="col-md-12 d-flex">
                            <div class="col-md-6">
                                <div class="card-body">
                                    Delivery from
                                    <input type="time" class="form-control" name="delivary_start" value="{{$from}}" min="{{$from}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    up to
                                    <input type="time" class="form-control" name="delivary_end" value="{{$up}}" min="{{$up}}">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- sekciaj padalinta i dvus pabaiga--}}
                <div class="col-md-3">
                    <div class="card-body">
                        <h6 class="card-title">Coments:</h6>
                        <textarea class="form-control" placeholder="Leave a comment here" name="comment_des" rows="4" cols="130" value=""></textarea>
                        <button type="submit" name="delete" class="btn btn-danger m-2 float-end" value="{{$food->id}}">Delete</button>
                        <button type="submit" name="update" value="{{$food->id}}" class="btn btn-info m-2 float-end">Update</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success m-2">BUY</button>

        </div>
        @empty
        <div class="col-md-12 ">
            <div class="card shadow bg-body-tertiary rounded ">
                <div class="card-header">
                    <h1>Basket empty</h1>
                </div>
            </div>
        </div>
        @endforelse
        @csrf
        @method('post')
        </form>

        @if($basketList->count())
        <div class="card mt-4">
            <div class="card-header justify-content-center ">
                <h3 class="m-3"><i>Total basket sum: <b>{{$basket->total}} &euro;</b></i></h3>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 66%"></div>
                </div>
                {{-- <form action="{{route('confirm-basket')}}" method="post"> --}}
                <a href="{{route('update-basket')}}" class="btn btn-secondary m-2 float-start">BACK</a>
                <button type="submit" name="confirm" value="{{$food->id}}" class="btn btn-primary m-2 float-end">Next</button>
                @csrf
                @method('post')
                </form>
            </div>
        </div>
        @endif
    </div>
</div>


@endsection
