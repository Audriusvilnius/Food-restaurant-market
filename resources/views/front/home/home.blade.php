@extends('layouts.front')
@section('content')
{{-- <section class="py-1 text-center container">
    <div class="col-lg-4 col-md-8 mx-auto mt-1 py-2">
        @if(Session::has('ok'))
        <h6 class=" alert alert-success alert-dismissible fade show border border-dark border-2" role="alert">{{Session::get('ok')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
@endif
</div>
</section> --}}
<div class="conteiner-blue">


<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up sticky-bottom">
        <i class="bi bi-chevron-up"></i>
    </div>
</a>
<section class="py-1 text-center container shadow_new">
    <h1 class="m-5">{{__('All Restaurants near me')  }}</h1>
    {{-- <h2 class="m-5 fs-3"><i>text</i></h2> --}}
    <hr class=" border border-second border-0 opacity-75">
</section>



    <section class="container shadow_new">
        <h3 class="text-start"><i>Restaurants</i></h3>
        {{-- <hr class="border border-second border-1 opacity-75"> --}}
    </section>
    @include('front.home.common.restaurant')
</div>

<section class="page conteiner-blue pb-3">
    <div class="container ">
        <div class="row">
            <div class="col-md-4 d-flex ">
                <form class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-10" role="search" action="{{url('/')}}" method="get">
                    <div class="card-body align-content-center gap-3 d-flex mb-2">

                        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="{{__('Search...')  }}  " aria-label="Search" name="s" value="{{$s}}">
                        <button type="submit" class="btn btn-info"><i class="bi bi-search"></i></button>

                    </div>
                </form>
            </div>
            <div class="col-md-2 ">
                {{-- <form action="{{url('/')}}" method="get">
                <select class="form-select form-select bg-dark text-white mb-2" name="restaurant_id">
                    <option value="all">{{__('All Cities')  }}</option>
                    @foreach($restaurants as $restaurant)
                    <option value="{{$restaurant->id}}" @if($restaurant->id == $cityShow) selected @endif>{{$restaurant->city}}</option>
                    @endforeach
                </select></form> --}}
            </div>
            <div class="col-md-2 ">
                <form action="{{url('/')}}" method="get">
                    <select class="form-select form-select bg-dark text-white mb-2" name="restaurant_id">
                        <option value="all">{{__('All Restaurants')  }}</option>
                        @foreach($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}" @if($restaurant->id == $typeShow) selected @endif>{{$restaurant->title}}</option>
                        @endforeach
                    </select>
            </div>

            <div class="col-md-1 btnsort">
                <div class="card-body align-content-center mb-2">
                    <select class="form-select bg-dark text-white " name="sort">
                        <option>{{__('Sort')  }}</option>
                        @foreach($sortSelect as $value => $name)
                        <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="card-body align-content-center d-flex mb-2">
                    <select class="form-select bg-dark text-white d-flex" name="per_page">
                        @foreach($perPageSelect as $value)
                        <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card-body align-content-end gap-1 d-flex float-end">
                    <button type="submit" class="btn btn-secondary mb-2">{{__('SHOW')  }}</button>
                    </form>
                    <a href=" {{url('/')}}" class="btn btn-danger mb-2" style="">{{__('RESET')  }}</a>
                </div>
            </div>
        </div>
    </div>
</section>



<hr class="border border-second border-0 opacity-50">
<div class="page" id="food-lists">
    <div class="container ">
        {{-- CIA keiciam steilpeliu skaiciu  --}}
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
            @forelse($foods as $food)

            <div id="{{ $food['id'] }}" class="col d-flex justify-content-md-between">

                <div class="card g-0 shadow p-0 bg-body-tertiary rounded">
                    <div class="container_pic">
                        <img src="{{asset($food->photo)}}" class="img-fluid rounded shadow bg-body-tertiary" alt=" hotel">
                        @foreach($restaurants as $restaurant)
                        @if($restaurant->id == $food->rest_id && $restaurant->works == 'false')
                        <div style="transform: translateX({{$restaurant->translateX}}px) translateY({{$restaurant->translateY}}px) rotate({{$restaurant->deg}}deg);" class="centered shadow_new justify-content-center text-block-sm">


                    <div class=" card-body ">
                        <a class="list-group-item list-group-item-action " href="{{route('list-restaurant',$food->foodReataurants_name->id)}}">
                            <h6>{{__('Restaurant')  }}: <b style="font-size:17px;"><i>
                                        {{$food->foodReataurants_name->title}}</b></i></h6>
                        </a>
                        <h6>{{__('City')  }}: <b><i>{{$food->foodCities_no->title}}</i></b></h6>
                        @if (app()->getLocale() == "lt")
                        <h6>{{__('Category')  }}: <b><i>{{$food->foodCategory_no->title_lt}}</i></b></h6>
                        @else
                        <h6>{{__('Category')  }}: <b><i>{{$food->foodCategory_no->title_en}}</i></b></h6>
                        @endif

                        {{-- <h6>{{__('City')  }}: <b><i>{{$food->foodReataurants_name->city}}</i></b></h6> --}}
                        <h6>{{__('Address')  }}: <b><i>{{$food->foodReataurants_name->addres}}</i></b></h6>
                        <h6>{{__('Open')  }}: <b><i>{{$food->foodReataurants_name->open}}</i></b></h6>
                        <h6>{{__('Close')  }}: <b><i>{{$food->foodReataurants_name->close}}</i></b></h6>
                        <hr class="border border-second border-2 opacity-50">
                        <h4><b><i>{{$food->title}}</b></i></h4>
                        <span class="text-muted">{{$food->add}}</span>

                        <h4 @if($food->price<20) style="color:crimson;" @endif>{{__('Price')  }}: <b><i>{{$food->price}} &euro;</b></i></h4>

                        <hr class="border border-second border-2 opacity-50">
                        {{-- <form action="{{route('update-rate')}}" method="post"> --}}
                        <div class="gap-3 align-items-center d-flex justify-content-center">
                        {{__('Rating')  }}:<b><i>{{$food->rating}}</i></b>
                            {{-- Rate:
                            <input type="hidden" name="product" value="{{$food->id}}">
                            <input type="hidden" name="user_name" value="{{$name}}">
                            <input type="number" min="1" max="5" name="rated" value="" placeholder="1 - 5" class="form-control imputnumber"> --}}
                            {{-- <div class="btn-group">
                                <button type="submit" class="btn btn-outline-secondary">{{__('RATE')  }}</button>
                            </div> --}}
                        </div>
                        {{-- @csrf --}}
                        {{-- </form> --}}
                        {{-- <hr class="border border-second border-2 opacity-50"> --}}
                        <form action="{{route('update-reviews')}}" method="get">
                            <div class="gap-3 align-items-center d-flex justify-content-center mt-3">
                                <input type="hidden" name="product" value="{{$food->id}}">
                                {{-- <input type="hidden" name="count" value="{{$food->counts}}"> --}}
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-outline-secondary" style="width:200px;">{{__('Rating & Reviews')  }}</button>
                                </div>
                            </div>
                            @csrf
                        </form>

                        <hr class="border border-second border-2 opacity-50">
                        <form action="{{route('add-basket')}}" method="post">
                            <div class="col-md-12 gap-3 align-items-center d-flex justify-content-center">
                                <div class="col-md-2">
                                {{__('Qty')  }}:
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="count" value="1" min="1">
                                    <input type="hidden" name="id" value="{{$food->id}}">
                                </div>
                                <div class="col-md-1 ">
                                    <div class="form-contro">
                                        <button type="submit" class="btn btn-dark">
                                            <i class="bi bi-cart-check-fill"></i>
                                        </button>

                                    </div>
                                    <form action="{{route('update-reviews')}}" method="get">
                                        <div class="gap-3 align-items-center d-flex justify-content-center mt-3">
                                            <input type="hidden" name="product" value="{{$food->id}}">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-outline-secondary" style="width:200px;">Rating & Reviews</button>
                                            </div>
                                        </div>
                                        @csrf
                                    </form>
                                    <hr class="border border-second border-2 opacity-0">
                                    <form action="{{route('add-basket')}}" method="post">
                                        <div class="col-md-12 gap-3 align-items-center d-flex justify-content-center">
                                            <div class="col-md-2">
                                                Qty:
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" name="count" value="1" min="1">
                                                <input type="hidden" name="id" value="{{$food->id}}">
                                            </div>
                                            <div class="col-md-1 ">
                                                <div class="form-contro">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="bi bi-cart-check-fill" style="font-size: 1rem"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @csrf
                                        </div>
                                    </form>
                                    <hr class="border border-second border-2 opacity-0">
                                </div>
                            </div>
                            <h4 class="mt-3"><b><i>{{$food->title}}</b></i></h4>
                            <span class="text-muted">{{$food->add}}</span>
                            <hr class="border border-second border-1 opacity-75">
                            <div class="justify-content-center align-bottom">
                                <h3 @if($food->price<20) style="color:crimson;" @endif><b><i>{{$food->price}} &euro;</b></i></h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        @empty
        <div class="col-xxl-12 col-xl-12 col-lg-12">
            <div class="card shadow bg-body-tertiary rounded d-flex ">
                <div class="card-header justify-content-md-between align-items-center">
                    <h1>{{__('Oops! No match found. Try again')  }}</h1>
                </div>
                <div class="card-header justify-content-md-between align-items-center">
                    <a href="{{route('start')}}" class="btn btn-secondary">{{__('BACK')  }}</a>

                </div>
            </div>
            @endforelse
        </div>
        <div class="mt-4">
            @if($perPageShow!='All')
            {{$foods->links()}}
            @endif
        </div>
    </div>
    <hr class="border border-second border-0 opacity-50 m-1">
    @endsection
