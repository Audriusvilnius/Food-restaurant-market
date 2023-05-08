@extends('layouts.app')
@section('content')

<style>
    .average-rating {
        position: relative;
        appearance: none;
        color: transparent;
        width: auto;
        display: inline-block;
        vertical-align: baseline;
        font-size: 25px;
    }

    .average-rating::before {
        content: '★★★★★';
        position: absolute;
        top: 0;
        left: 0;
        color: rgba(0, 0, 0, 0.2);

        background: linear-gradient(90deg, gold {
                    {
                    ($food->rating / 5) * 100
                }
            }

            %, rgba(0, 0, 0, 0.2) {
                    {
                    ($food->rating / 5) * 100
                }
            }

            %);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

    }

    /* Netrinti */

</style>

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
                            <h6 class="fs-5">{{__('City') }}: <b><i>{{$food->foodCities_no->title}}</i></b></h6>
                            <h6 class="fs-5">{{__('Restaurant') }}: <b><i>{{$food->foodReataurants_name->title}}</b></i></h6>
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
                                <div class="card-body d-flex">

                                    <input type="hidden" name="product" value="{{ $food->id }}">
                                    {{-- <input type="number" min="1" max="5" name="rated" value="3"
                                            placeholder="1 - 5" class="form-control imputnumber"> --}}
                                    <div class="star-rating">
                                        <input class="radio-input" type="radio" id="star5" name="rated" value="5" required />
                                        <label class="radio-label" class for="star5" title="5 stars">5 stars</label>
                                        {{-- Jeigu ką čia ieškot --}}
                                        <input class="radio-input" type="radio" id="star4" name="rated" value="4" />
                                        <label class="radio-label" for="star4" title="4 stars">4 stars</label>

                                        <input class="radio-input" type="radio" id="star3" name="rated" value="3" />
                                        <label class="radio-label" for="star3" title="3 stars">3 stars</label>

                                        <input class="radio-input" type="radio" id="star2" name="rated" value="2" />
                                        <label class="radio-label" for="star2" title="2 stars">2 stars</label>

                                        <input class="radio-input" type="radio" id="star1" name="rated" value="1" />
                                        <label class="radio-label" for="star1" title="1 star">1 star</label>
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
            <div class="col-md-10">
                <h4>{{ $reviews['user_name'] }}</h4>
            </div>
            {{-- <h4 class="float-end "> Raited {{ $reviews['rate'] }}</h4> --}}
            <div id="rating-score">
                <meter class="average-rating" min="0" max="5" value="4.3" title="ratingScore"></meter>
            </div>
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
