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

<div class="container pt-5 pb-5" style="min-height: 900px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($basketList->count())
            <div class="card-header justify-content-center">
                <h1>{{__('Basket') }}</h1>
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
                                <h6>{{__('Price') }}: <b><i>{{number_format($food->price, 2, '.', '') }} &euro;</b></i></h6>
                                <h6>{{__('Delivery Fee')  }}: <b class="text-success"><i>{{$basket->delivery($food->foodReataurants_name->title)}} </i></b></h6>
                                <br>
                                <div class="gap-3 align-items-center d-flex justify-content-center">
                                    {{__('Quantity') }}:
                                    {{-- <h6>{{__('Rating')  }}: <b><i>{{$food->rating}}</b></i></h6>
                                    <h6>{{__('Voted') }}: <b><i>{{$food->counts}}</b></i></h6> --}}
                                    <input type="number" class="form-control imputnumber" name="count[]" value="{{$food->count}}" min="1">
                                    <input type="hidden" class="form-control" name="ids[]" value="{{$food->id}}">
                                    {{-- <input type="hidden" class="form-control" name="id" value="{{$food->id}}"> --}}

                                    @if ( $basket->getFlag() == 0 )
                                    <h6> {{__('Sum') }}: <b><i>{{number_format($food->count*$food->price, 2, '.', '')}} &euro;</b></i></h6>
                                    @else
                                    <h6>{{__('Sum') }}: <b><i>{{number_format(($food->count*$food->price)+4.99, 2, '.', '')}} &euro;</b></i></h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- sekciaj padalinta i dvus pradzia--}}
                        <div class="col-md-3 d-flex">
                            <div class="card-body align-items-center justify-content-center">

                                <h6>{{__('Restaurant') }}: <b><i>{{$food->foodReataurants_name->title}}</b></i></h6>
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-6">
                                        <h6>{{__('Open') }}: <b><i>{{$food->foodReataurants_name->open}}</b></i></h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>{{__('Close') }}: <b><i>{{$food->foodReataurants_name->close}}</b></i></h6>
                                    </div>
                                </div>
                                <h6 class="card-title text-muted">{{__('Additional info')  }}:</h6>
                                <p class="card-text"><small class="text-muted">{{$food->add}}</small></p>
                            </div>
                        </div>
                        {{-- sekciaj padalinta i dvus pabaiga--}}
                        <div class="col-md-3">
                            <div class="card-body">
                                <h6 class="card-title">{{__('Description') }}:</h6>
                                <textarea class="form-control" placeholder="{{$food->des}}" rows="5" cols="auto"></textarea>
                                <button type="submit" name="delete" class="btn btn-danger m-2 float-end" value="{{$food->id}}">{{__('Delete') }}</button>
                                <button type="submit" name="update" value="{{$food->id}}" class="btn btn-info m-2 float-end">{{__('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card shadow bg-body-tertiary rounded ">
                        <div class="card-body align-items-center justify-content-center d-flex">
                            <h1>{{__('Basket empty')  }}</h1>
                        </div>
                        <div class="card-body align-items-center justify-content-center d-flex">
                            <a href="{{route('start')}}" class="btn btn-secondary">{{__('BACK') }}</a>
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
                    <a href="{{route('start')}}" class="btn btn-secondary float-start">{{__('BACK') }}</a>
                    <h3 class="m-3"><i>{{__('Total basket sum')  }}: <b>{{number_format((float)$basket->total, 2, '.', '')}} &euro;</b></i></h3>
                    <div class="justify-content-end d-flex">
                        <form action="{{route('make-order')}}" method="post">
                            <button type="submit" name="confirm" class="btn btn-success" style="width: 80px;">{{__('BUY') }}</button>

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
