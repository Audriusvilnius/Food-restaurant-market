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
                    <h1>All Restourants</h1>
                </div>
            </div>
            @forelse($restaurants as $restaurant)
            <div id="{{ $restaurant['id'] }}" class="card mt-2" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-4">
                        <img src="{{asset($restaurant->photo)}}" class="img-fluid rounded" alt="imageset">
                    </div>
                    {{-- sekciaj padalinta i dvus pradzia--}}
                    <div class="col-md-4">
                        <div class="card-body ms-2">
                            <h6>Restaurant: <b><i>{{$restaurant->title}}</i></b></h6>
                            <h6>City: <b><i>{{$restaurant->city}}</i></b></h6>
                            <h6>Addres: <b><i>{{$restaurant->addres}}</i></b></h6>
                            <div class="col-md-12 d-flex">
                                <div class="col-md-3">
                                    <h6>Open: <b><i>{{$restaurant->open}}</i></b></h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Close: <b><i>{{$restaurant->close}}</i></b></h6>
                                </div>
                            </div>
                            <h6>Dish qty.: <b><i>{{$restaurant->food_Restaurant()->count()}}</i></b></h6>
                            <h6 class="card-title text-muted">Phone:</h6>
                            <p class="card-text"><small class="text-muted">{{$restaurant->phone}}</small></p>
                        </div>
                    </div>
                    {{-- sekciaj padalinta i dvus pabaiga--}}
                    <div class="col-md-4">
                        <div class="card-body">
                            <h6 class="card-title">Description:</h6>
                            <textarea class="form-control" placeholder="{{$restaurant->des}}" rows="5" cols="auto"></textarea>

                            <div class="list-table__buttons gap-3 mt-3">
                                <a href="{{route('restaurants-edit', $restaurant)}}" class="btn btn-secondary" style="width: 80px;">EDIT</a>

                                <form action="{{route('restaurants-delete', $restaurant)}}" method="post">
                                    <button type="submit" class="btn btn-danger" style="width: 80px;">DELET</button>

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
