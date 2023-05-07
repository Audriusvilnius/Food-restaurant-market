@extends('layouts.front')
@section('content')

    <div class="conteiner-blue">
        <section class="py-1 text-center container shadow_new btnFront">
            <a class="list-group-item list-group-item-action" href="{{ route('start') }}">
                <div class="btn btn-dark mt-5">
                    <h1 class="m-3 shadow_new">{{ __('All Restaurants near me') }}</h1>
                </div>
            </a>
            <hr class="border border-second border-0 opacity-75">
        </section>

        <section class="container shadow_new">
            <h3 class="mt-1 text-end"><i>{{ __('Categories') }}</i></h3>

            {{-- <hr class="border border-second border-1 opacity-75"> --}}
        </section>
        @include('front.home.common.category')

        <section class="container shadow_new">
            <h3 class="text-start"><i>{{ __('Restaurants') }}</i></h3>
            {{-- <hr class="border border-second border-1 opacity-75"> --}}
        </section>
        @include('front.home.common.restaurant')
    </div>

    @include('layouts.find')

    <div class="page pt-5" id="food-lists">
        <div class="container">

            {{-- container-fluid --}}
            {{-- CIA keiciam steilpeliu skaiciu  --}}
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
                @forelse($foods as $key=>$food)
                    <div id="{{ $food['id'] }}" class="col d-flex justify-content-md-between">
                        <div class="card g-0 shadow p-0 bg-body-tertiary rounded">
                            <div class="container_pic">
                                <img src="{{ asset($food->photo) }}" class="img-fluid rounded shadow bg-body-tertiary"
                                    alt=" hotel">
                                @foreach ($restaurants as $restaurant)
                                    @if ($restaurant->id == $food->rest_id && $restaurant->works == 'false')
                                        <div style="transform: translateX({{ $restaurant->translateX }}px) translateY({{ $restaurant->translateY }}px) rotate({{ $restaurant->deg }}deg);"
                                            class="centered shadow_new justify-content-center text-block-sm">
                                            <div onmouseover="mOver({{ $key }})"
                                                onmouseout="mOut({{ $key }})">
                                                <div class="appBannerT{{ $key }}" style="display: none;">open
                                                    {{ $restaurant->open }}</div>
                                                <div class="appBannerB{{ $key }}" style="display: inline;">closed
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <h6 class="mt-3"><i>{{ $food->foodReataurants_name->title }}</i></h6>

                            <div class="justify-content-center align-bottom">
                                @if (app()->getLocale() == 'lt')
                                    <h4 class="mt-3"><b><i>{{ $food->title_lt }}</b></i></h4>
                                @else
                                    <h4 class="mt-3"><b><i>{{ $food->title_en }}</b></i></h4>
                                @endif
                                <h3 @if ($food->price < 20) style="color:crimson;" @endif><b>{{ __('Price') }}:
                                        <i>{{ $food->price }} &euro;</b></i></h3>
                                <div class="ms-10">
                                    <h5 class="mt-10"><i> {{ __('Rating') }}:</i></h5>
                                        <div id="rating-score">
                                            <script>
                                                for (let i = 0; i < Math.round({{ $food->rating }}); i++) {
                                                    document.write('<div class="star"></div>');
                                                }
                                            </script>
                                        </div>
                                </div>
                            </div>
                            <div class=" card-body ">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h6 class="accordion-header " id="flush-headingOne">
                                            <button class="accordion-button collapsed rounded" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                <div style="font-size:17px;">
                                                    <i>{{ $food->foodReataurants_name->title }}</i>
                                                </div>
                                            </button>
                                        </h6>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body ">
                                                <h6>{{ __('City') }}: <b><i>{{ $food->foodCities_no->title }}</i></b>
                                                </h6>
                                                @if (app()->getLocale() == 'lt')
                                                    <h6>{{ __('Category') }}:
                                                        <b><i>{{ $food->foodCategory_no->title_lt }}</i></b>
                                                    </h6>
                                                @else
                                                    <h6>{{ __('Category') }}:
                                                        <b><i>{{ $food->foodCategory_no->title_en }}</i></b>
                                                    </h6>
                                                @endif
                                                <h6>{{ __('Address') }}:
                                                    <b><i>{{ $food->foodReataurants_name->addres }}</i></b>
                                                </h6>
                                                <h6>{{ __('Open') }}:
                                                    <b><i>{{ $food->foodReataurants_name->open }}</i></b>
                                                </h6>
                                                <h6>{{ __('Close') }}:
                                                    <b><i>{{ $food->foodReataurants_name->close }}</i></b>
                                                </h6>
                                                @if (app()->getLocale() == 'lt')
                                                    <span class="text-muted">{{ $food->des_lt }}</span>
                                                @else
                                                    <span class="text-muted">{{ $food->des_en }}</span>
                                                @endif

                                            </div>
                                            <form action="{{ route('update-reviews') }}" method="get">
                                                <div class="gap-3 align-items-center d-flex justify-content-center mt-3">
                                                    <input type="hidden" name="product" value="{{ $food->id }}">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-outline-secondary"
                                                            style="width:200px;">{{ __('Rating & Reviews') }}</button>
                                                    </div>
                                                </div>
                                                @csrf
                                            </form>
                                            <hr class="border border-second border-2 opacity-0">
                                        </div>
                                    </div>
                                    {{-- <hr class="border border-second border-1 opacity-75"> --}}
                                    <hr class="border border-second border-2 opacity-0">

                                    <form action="{{ route('add-basket') }}" method="post">
                                        <div class="col-md-12 gap-3 align-items-center d-flex justify-content-center">
                                            <div class="col-md-2">
                                                {{ __('Qty') }}:
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" class="form-control" name="count" value="1"
                                                    min="1">
                                                <input type="hidden" name="id" value="{{ $food->id }}">
                                            </div>
                                            <div class="col-md-1 ">
                                                <div class="form-contro">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="bi bi-cart-check-fill" style="font-size: 1rem"></i>
                                                    </button>
                                                </div>

{{--

Dev buvo toks:

<div class="conteiner-blue">
    <section class="py-1 text-center container shadow_new btnFront">
        <a class="list-group-item list-group-item-action" href="{{route('start')}}">
            <div class="btn btn-dark mt-5">
                <h1 class="m-3 shadow_new">{{__('All Restaurants near me')  }}</h1>
            </div>
        </a>
        <hr class=" border border-second border-0 opacity-75">
    </section>

    <section class="container shadow_new">
        <h3 class="mt-1 text-end"><i>{{__('Categories') }}</i></h3>

    </section>
    @include('front.home.common.category')

    <section class="container shadow_new">
        <h3 class="text-start"><i>{{__('Restaurants')}}</i></h3>}
    </section>
    @include('front.home.common.restaurant')
</div>

@include('layouts.find')

<div class="page pt-5" id="food-lists">
    <div class="container">

        /* container-fluid */
        /* CIA keiciam steilpeliu skaiciu  */

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
            @forelse($foods as $key=>$food)
            <div id="{{ $food['id'] }}" class="col d-flex justify-content-md-between">
                <div class="card g-0 shadow p-0 bg-body-tertiary rounded">
                    <div class="container_pic">
                        <img src="{{asset($food->photo)}}" class="img-fluid rounded shadow bg-body-tertiary" alt=" hotel">
                        @foreach($restaurants as $restaurant)
                        @if($restaurant->id == $food->rest_id && $restaurant->works == 'false')
                        <div style="transform: translateX({{$restaurant->translateX}}px) translateY({{$restaurant->translateY}}px) rotate({{$restaurant->deg}}deg);" class="centered shadow_new justify-content-center text-block-sm">
                            <div onmouseover="mOver({{$key}})" onmouseout="mOut({{$key}})">
                                <div class="appBannerT{{$key}}" style="display: none;">open {{$restaurant->open}}</div>
                                <div class="appBannerB{{$key}}" style="display: inline;">closed</div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <h6 class="mt-3"><i>{{$food->foodReataurants_name->title}}</i></h6>

                    <div class="justify-content-center align-bottom">
                        @if (app()->getLocale() == "lt")
                        <h4 class="mt-3"><b><i>{{$food->title_lt}}</b></i></h4>
                        @else
                        <h4 class="mt-3"><b><i>{{$food->title_en}}</b></i></h4>
                        @endif
                        <h3 @if($food->price<20) style="color:crimson;" @endif><b>{{__('Price') }}: <i>{{$food->price}} &euro;</b></i></h3>
                    </div>
                    <div class=" card-body ">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h6 class="accordion-header " id="flush-headingOne">
                                    <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <div style="font-size:17px;">
                                            <i>{{$food->foodReataurants_name->title}}</i>
                                        </div>
                                        <div class="ms-5">
                                            {{__('Rating') }}:
                                            <div id="rating-score">
                                                <script>
                                                    for (let i = 0; i < Math.round({
                                                            {
                                                                $food - > rating
                                                            }
                                                        }); i++) {
                                                        document.write('<div class="star"></div>');
                                                    }

                                                </script>
                                            </div>
                                        </div>
                                    </button>
                                </h6>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body ">
                                        <h6>{{__('City') }}: <b><i>{{$food->foodCities_no->title}}</i></b></h6>
                                        @if (app()->getLocale() == "lt")
                                        <h6>{{__('Category') }}: <b><i>{{$food->foodCategory_no->title_lt}}</i></b></h6>
                                        @else
                                        <h6>{{__('Category') }}: <b><i>{{$food->foodCategory_no->title_en}}</i></b></h6>
                                        @endif
                                        <h6>{{__('Address') }}: <b><i>{{$food->foodReataurants_name->addres}}</i></b></h6>
                                        <h6>{{__('Open') }}: <b><i>{{$food->foodReataurants_name->open}}</i></b></h6>
                                        <h6>{{__('Close') }}: <b><i>{{$food->foodReataurants_name->close}}</i></b></h6>
                                        @if (app()->getLocale() == "lt")
                                        <span class="text-muted">{{$food->des_lt}}</span>
                                        @else
                                        <span class="text-muted">{{$food->des_en}}</span>
                                        @endif

                                    </div>
                                    <form action="{{route('update-reviews')}}" method="get">
                                        <div class="gap-3 align-items-center d-flex justify-content-center mt-3">
                                            <input type="hidden" name="product" value="{{$food->id}}">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-outline-secondary" style="width:200px;">{{__('Rating & Reviews')  }}</button>
--}}

                                            </div>
                                        </div>
                                        @csrf
                                    </form>
                                </div>
                                <div class=" col-md-12 d-flex">
                                    <div class="col-md-4">
                                    </div>
                                </div>
                                @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="card shadow bg-body-tertiary rounded d-flex ">
                            <div class="card-header justify-content-md-between align-items-center">
                                <h1>{{ __('Oops! No match found. Try again') }}</h1>

                            </div>
                            <div class="card-header justify-content-md-between align-items-center">
                                <a href="{{ route('start') }}" class="btn btn-secondary">{{ __('BACK') }}</a>
                            </div>
                        </div>
                @endforelse
            </div>
            <div class="mt-4">
                @if ($perPageShow != 'All')
                    {{ $foods->links() }}
                @endif
            </div>

{{--

Dev buvo toks:

                                    <hr class="border border-second border-2 opacity-0">
                                </div>
                            </div>
                            /*  <hr class="border border-second border-1 opacity-75"> */
                            <hr class="border border-second border-2 opacity-0">

                            <form action="{{route('add-basket')}}" method="post">
                                <div class="col-md-12 gap-3 align-items-center d-flex justify-content-center">
                                    <div class="col-md-2">
                                        {{__('Qty') }}:
                                    </div>
                                    <div class="col-md-3">
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
                                </div>
                                @csrf
                            </form>
                        </div>
                        <div class=" col-md-12 d-flex">
                            <div class="col-md-4">
                            </div>
                        </div>
                        @csrf
                        </form>
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
                        <a href="{{route('start')}}" class="btn btn-secondary">{{__('BACK') }}</a>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="mt-4">
                @if ($perPageShow != 'All')
                {{ $foods->links() }}
                @endif
            </div>
--}}

        </div>
        <hr class="border border-second border-0 opacity-50 m-1">
    </div>
@endsection
n
