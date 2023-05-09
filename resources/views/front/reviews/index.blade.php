@extends('layouts.app')
@section('content')


<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up sticky-bottom">
        <i class="bi bi-chevron-up"></i>
    </div>
</a>

<div class="container mb-5" style="min-height: 850px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h1 class="fs-2">{{ __('Hello') }}, {{ $name }}! {{ __('You can rate & review') }}
                        {{ $food->title }}</h1>
                </div>
            </div>
            <div class="card mt-2 d-flex justify-content-md-between">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-6">
                        <img src="{{ asset($food->photo) }}" class="img-fluid rounded" alt="imageset">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            {{-- Reikia tvarkyti , nerodo title ir city, nes pasikeite pavadinimai kitamuju
                             --}}
                            @if (app()->getLocale() == 'lt')
                            <h6 class="fs-5">{{ __('Category') }}:
                                <b><i>{{ $food->foodCategory_no->title_lt }}</i></b>
                            </h6>
                            @else
                            <h6 class="fs-5">{{ __('Category') }}:
                                <b><i>{{ $food->foodCategory_no->title_en }}</i></b>
                            </h6>
                            @endif
                            <h6 class="fs-5">{{ __('Price') }}: <b><i>{{ $food->price }} &euro;</i></b></h6>
                            <h6 class="fs-5">{{ __('Rating') }}: <b><i>{{ $food->rating }}</i></b></h6>
                            <h6 class="fs-5">{{ __('Voted') }}: <b><i>{{ $food->counts }}</i></b></h6>
                            <h6 class="fs-5">{{ __('City') }}: <b><i>{{ $food->foodCities_no->title }}</i></b>
                            </h6>
                            <h6 class="fs-5">{{ __('Restaurant') }}:
                                <b><i>{{ $food->foodReataurants_name->title }}</b></i>
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fs-5">{{ __('Open') }}:
                                        <b><i>{{ $food->foodReataurants_name->open }}</b></i>
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fs-5">{{ __('Close') }}:
                                        <b><i>{{ $food->foodReataurants_name->close }}</b></i>
                                    </h6>
                                </div>
                            </div>
                            <hr class="border border-second border-2 opacity-50">
                            <h6 class="card-title text-muted">{{ __('Additional info') }}:</h6>
                            <p class="card-text"><small class="text-muted">{{ $food->add }}</small></p>
                        </div>
                    </div>
                    <form action="{{ route('update-rate') }}" method="post">
                        <div class="gap-3 align-items-center justify-content-center">
                            <div class="col-md-12 d-flex">

                                <div class="card-body d-flex justify-content-end">
                                    <input type="hidden" name="product" value="{{ $food->id }}">
                                    {{-- <input type="number" min="1" max="5" name="rated" value="3"
                                            placeholder="1 - 5" class="form-control imputnumber"> --}}
                                    <div class="star-rating">

                                        <input class="radio-input " type="radio" id="star5" name="rated" value="5" required />
                                        <label class="radio-label me-2" class for="star5" title="5 stars">5 stars</label>

                                        {{-- Jeigu ką čia ieškot --}}
                                        <input class="radio-input" type="radio" id="star4" name="rated" value="4" />
                                        <label class="radio-label me-2" for="star4" title="4 stars">4 stars</label>


                                        <input class="radio-input " type="radio" id="star3" name="rated" value="3" />
                                        <label class="radio-label me-2" for="star3" title="3 stars">3 stars</label>


                                        <input class="radio-input" type="radio" id="star2" name="rated" value="2" />
                                        <label class="radio-label me-2" for="star2" title="2 stars">2 stars</label>


                                        <input class="radio-input" type="radio" id="star1" name="rated" value="1" />
                                        <label class="radio-label me-2" for="star1" title="1 star">1 star</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex">
                            <div class="card-body">
                                <textarea class="form-control" placeholder="{{ __('Leave Review here') }}" name="food_review" rows="5" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex">
                            <div class="card-body">
                                <a href="{{ route('start') }}" class="btn btn-secondary float-start">{{ __('HOME') }}</a>
                                <button type="submit" class="btn btn-outline-secondary float-end">{{ __('RATE & REVIEW') }}</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($rateds)
    @foreach ($rateds as $id => $reviews)
    <div id={{ $id }} class="card mt-2 d-flex justify-content-md-between">
        <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
            <div class="col-md-9">
                <h4>{{ $reviews['user_name'] }}</h4>
            </div>
            <div class="col-md-3 ">
                @for ($i = 0; $i < $reviews['rate'] ; $i++) <span class="float-end d-flex me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" style="color:orange;" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    </span>
                    @endfor
            </div>
            {{-- <div class="average-rating ms-5"> --}}
            {{-- <meter class="average-rating" min="0" max="5" value="4.3" title="ratingScore"></meter> --}}
            {{-- </div> --}}
            <div class="col-md-12 d-flex">
                <div class="card-body ms-5 me-5">
                    {{-- <h4 class="float-end fw-light">{{ $reviews['review'] }}</h4> --}}
                    <p class="card-text">{{ $reviews['review'] }}</p>
                </div>
            </div>
            <div class="col-md-12 d-flex">
                <div class="card-body ms-5 me-5">
                    <h6 class="float-end">{{ $reviews['date'] }}</h6>
                </div>
            </div>

        </div>

    </div>
    @endforeach
    @endif
</div>
@endsection
