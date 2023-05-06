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
                    <h1 class="fs-2>{{__('Hello')  }}, {{$name}}! {{__('You can rate & review')  }} {{$food->title}}</h1>
                </div>
                <div class="card mt-2 d-flex justify-content-md-between">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-6">
                            <div class="card-body">
                                <img src="{{ asset($food->photo) }}" class="img-fluid rounded" alt="imageset">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card-body">
                            <h6 class="fs-5">{{__('Food')  }}: <b><i>{{$food->title}}</b></i></h6>
                            <h6 class="fs-5">{{__('Price')  }}: <b><i>{{$food->price}} &euro;</b></i></h6>
                            <h6 class="fs-5">{{__('Rating')  }}: <b><i>{{$food->rating}}</b></i></h6>
                            <h6 class="fs-5">{{__('Voted')  }}: <b><i>{{$food->counts}}</b></i></h6>
                            <h6 class="fs-5">{{__('City')  }}: <b><i>{{$food->foodReataurants_name->city}}</b></i></h6>
                            <h6 class="fs-5">{{__('Restaurant')  }}: <b><i>{{$food->foodReataurants_name->title}}</b></i></h6>
                            <div class="col-md-12 d-flex">
                                <div class="col-md-6">
                                    <h6 class="fs-5">{{__('Open')  }}: <b><i>{{$food->foodReataurants_name->open}}</b></i></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fs-5">{{__('Close')  }}: <b><i>{{$food->foodReataurants_name->close}}</b></i></h6>
                                </div>
                                <hr class="border border-second border-2 opacity-50">
                                <h6 class="card-title text-muted fs-5">Additional info:</h6>
                                <p class="card-text"><small class="text-muted">{{ $food->add }}</small></p>
                            </div>
                                                        <h6 class="card-title text-muted">{{__('Additional info')  }}:</h6>
                            <p class="card-text"><small class="text-muted">{{$food->add}}</small></p>
                        </div>
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
                                            <input class="radio-input" type="radio" id="star5" name="rated"
                                                value="5" required />
                                            <label class="radio-label" class for="star5" title="5 stars">5 stars</label>
// Jeigu ką čia ieškot
                                            <input class="radio-input" type="radio" id="star4" name="rated"
                                                value="4" />
                                            <label class="radio-label" for="star4" title="4 stars">4 stars</label>

                                            <input class="radio-input" type="radio" id="star3" name="rated"
                                                value="3" />
                                            <label class="radio-label" for="star3" title="3 stars">3 stars</label>

                                            <input class="radio-input" type="radio" id="star2" name="rated"
                                                value="2" />
                                            <label class="radio-label" for="star2" title="2 stars">2 stars</label>

                                            <input class="radio-input" type="radio" id="star1" name="rated"
                                                value="1" />
                                            <label class="radio-label" for="star1" title="1 star">1 star</label>
                                        </div>
                                    </div>
                                </div>

/*
                                <div class="col-md-12 d-flex">
                                    <div class="card-body">
                                        <textarea class="form-control" placeholder="Write a review here..." name="food_review" rows="5"
                                            cols="50"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <div class="card-body">
                                        <a href="{{ route('start') }}" class="btn btn-secondary float-start">HOME</a>
                                        <button type="submit" class="btn btn-outline-secondary float-end">RATE &
                                            REVIEW</button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
*/
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="card-body">
                                    <textarea class="form-control" placeholder="{{__('Leave Review here')  }}" name="food_review" rows="5" cols="50"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="card-body">
                                    <a href="{{route('start')}}" class="btn btn-secondary float-start">{{__('HOME')  }}</a>
                                    <button type="submit" class="btn btn-outline-secondary float-end">{{__('RATE & REVIEW')  }}</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
            <section class="py-1 text-center container">
                <div class="col-lg-4 col-md-8 mx-auto mt-1 py-2">
                    @if(Session::has('ok'))
                    <h6 class=" alert alert-success alert-dismissible fade show border border-dark border-2" role="alert">{{Session::get('ok')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                    @endif
                    @if(Session::has('not'))
                    <h6 class=" alert alert-danger alert-dismissible fade show" role="alert">{{Session::get('not')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </h6>
                    @endif
                </div>
            </section>
            @if($rateds)
            @foreach($rateds as $id => $reviews)
            <div id={{$id}} class="card mt-2 d-flex justify-content-md-between">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-4">
                        <h4>{{$reviews['user_name']}}</h4>
                    </div>
                    <div class="col-md-8">
                        <h4 class="float-end "> {{__('Rated')  }} {{$reviews['rate']}}</h4>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="card-body ms-5 me-5">
                            <h4 class="float-start fw-light">{{$reviews['review']}}</h4>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="card-body ms-5 me-5">
                            <h6 class="float-end">{{$reviews['date']}}</h6>
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
                                    <meter class="average-rating" min="0" max="5" value="4.3"
                                        title="ratingScore"></meter>
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
        </div>
    </div>
@endsection
