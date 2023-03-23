@extends('layouts.app')
@section('content')
<section class="py-1 text-center container">
    <div class="col-lg-4 col-md-8 mx-auto mt-1 fixed-top py-2">
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
<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up sticky-bottom">
        <i class="bi bi-chevron-up"></i>
    </div>
</a>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h1>Food list</h1>
                </div>
            </div>

            @forelse($foods as $food)
            <div id="{{$food['id'] }}" class="card mt-2 d-flex justify-content-md-between">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-5">
                        <img src="{{asset($food->photo)}}" class="img-fluid rounded" alt="imageset">
                    </div>
                    {{-- sekciaj padalinta i dvus pradzia--}}
                    <div class="col-md-3 d-flex">
                        <div class="card-body ms-2">
                            <h6>Food: <b><i>{{$food->title}}</b></i></h6>
                            <h6>Price: <b><i>{{$food->price}} &euro;</b></i></h6>
                            <h6>Raiting: <b><i>{{$food->rating}}</b></i></h6>
                            <h6>Voted: <b><i>{{$food->counts}}</b></i></h6>
                            <hr class="border border-second border-2 opacity-50">


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
                    <div class="col-md-4">
                        <div class="card-body">
                            <h6 class="card-title">Description:</h6>
                            <textarea class="form-control" placeholder="{{$food->des}}" rows="7" cols="auto"></textarea>
                        </div>
                        <div class="card-body">
                            <div class="list-table__buttons gap-3">
                                <a href="{{route('foods-edit', $food)}}" class="btn btn-secondary" style="width: 80px;">Edit</a>
                                <form action="{{route('foods-delete', $food)}}" method="post">
                                    <button type="submit" class="btn btn-danger" style="width: 80px;">Delete</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <h2 class="list-group-item">No types yet</h2>
            @endforelse
        </div>
    </div>
</div>


@endsection
