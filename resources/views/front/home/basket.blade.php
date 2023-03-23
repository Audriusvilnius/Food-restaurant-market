@inject('basket', 'App\Services\BasketService')
@extends('layouts.app')
@section('content')


<section class="py-1 text-center container">
    <div class="col-lg-4 col-md-8 mx-auto mt-1 fixed-top py-2">
        @if(Session::has('ok'))
        <h6 class=" alert alert-success alert-dismissible fade show border border-dark border-2" role="alert">{{Session::get('ok')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
        @endif
    </div>
</section>
<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up sticky-bottom">
        <i class="bi bi-chevron-up"></i>
    </div>
</a>

<div class="container mb-5" style="min-height: 850px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($basketList->count())
            <div class="card">
                <div class="card-header justify-content-center">
                    <h1>Basket</h1>
                </div>
            </div>
            @endif
            <form action="{{route('update-basket')}}" method="post">
                @forelse($basketList as $food)
                <div class="card mt-2 d-flex justify-content-md-between">
                    <div id="{{$food['id'] }}" class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-3 d-flex align-items-center">
                            <img src="{{asset($food->photo)}}" class="img-fluid rounded" alt="imageset">
                        </div>
                        <div class="col-md-3">
                            <div class="card-body">
                                <h5><b><i>{{$food->title}}</b></i></h5>
                                <h6>Price: <b><i>{{number_format($food->price, 2, '.', '') }} &euro;</b></i></h6>
                                <div class="gap-3 align-items-center d-flex justify-content-center">
                                    Quantity:
                                    {{-- <h6>Raiting: <b><i>{{$food->rating}}</b></i></h6>
                                    <h6>Voted: <b><i>{{$food->counts}}</b></i></h6> --}}
                                    <input type="number" class="form-control imputnumber" name="count[]" value="{{$food->count}}" min="1">
                                    <input type="hidden" class="form-control" name="ids[]" value="{{$food->id}}">
                                    {{-- <input type="hidden" class="form-control" name="id" value="{{$food->id}}"> --}}
                                    <h6> Sum: <b><i>{{number_format($food->count*$food->price, 2, '.', '')}} &euro;</b></i></h6>
                                </div>
                            </div>


                        </div>
                        {{-- sekciaj padalinta i dvus pradzia--}}
                        <div class="col-md-3 d-flex">
                            <div class="card-body align-items-center justify-content-center">

                                <h6>Restaurant: <b><i>{{$food->foodReataurants_name->title}}</b></i></h6>
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-6">
                                        <h6>Open: <b><i>{{$food->foodReataurants_name->open}}</b></i></h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Close: <b><i>{{$food->foodReataurants_name->close}}</b></i></h6>
                                    </div>
                                </div>
                                <h6 class="card-title text-muted">Additional info:</h6>
                                <p class="card-text"><small class="text-muted">{{$food->add}}</small></p>
                            </div>
                        </div>
                        {{-- sekciaj padalinta i dvus pabaiga--}}
                        <div class="col-md-3">
                            <div class="card-body">
                                <h6 class="card-title">Description:</h6>
                                <textarea class="form-control" placeholder="{{$food->des}}" rows="5" cols="auto"></textarea>
                                <button type="submit" name="delete" class="btn btn-danger m-2 float-end" value="{{$food->id}}">Delete</button>
                                <button type="submit" name="update" value="{{$food->id}}" class="btn btn-info m-2 float-end">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card shadow bg-body-tertiary rounded ">
                        <div class="card-body align-items-center justify-content-center d-flex">
                            <h1>Basket empty</h1>
                        </div>
                        <div class="card-body align-items-center justify-content-center d-flex">
                            <a href="{{route('start')}}" class="btn btn-secondary">BACK</a>
                        </div>
                    </div>
                </div>

                @endforelse
                @csrf
                @method('post')
            </form>

            @if($basketList->count())
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-md-between align-items-center">
                    <a href="{{route('start')}}" class="btn btn-secondary float-start">BACK</a>
                    <h3 class="m-3"><i>Total basket sum: <b>{{number_format((float)$basket->total, 2, '.', '')}} &euro;</b></i></h3>
                    <div class="justify-content-end d-flex">
                        <form action="{{route('make-order')}}" method="post">
                            <button type="submit" name="confirm" class="btn btn-success" style="width: 80px;">BUY</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
