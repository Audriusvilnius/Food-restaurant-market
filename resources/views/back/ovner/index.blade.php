@extends('layouts.app')
@section('content')
<section class="py-1 text-center container">
    <div class="col-lg-4 col-md-8 mx-auto mt-1  py-2">
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
                    <h1>Ovner</h1>
                </div>
            </div>
            @forelse($ovners as $ovner)
            <div id="{{$ovner['id'] }}" class="card mt-2 d-flex justify-content-md-between">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-4">
                        <img src="{{asset($ovner->photo)}}" class="img-fluid rounded" alt="imageset">
                        <div class="card-body">
                            <h5><b><i> {{$ovner->title}}</b></i></h5>
                            Addres:
                            <div class="col-md-12 d-flex">
                                <div class="col-md-7">
                                    <h6>Street: <b><i>{{$ovner->street}}</b></i></h6>
                                </div>
                                {{-- <div class="col-md-1"> --}}
                                {{-- </div> --}}
                                <div class="col-md-4">
                                    <h6>Build: <b><i>{{$ovner->build}}</b></i></h6>
                                </div>
                            </div>

                            {{-- sekciaj padalinta i dvus pradzia--}}
                            <div class="col-md-12 d-flex">
                                <div class="col-md-7">
                                    <h6>City: <b><i>{{$ovner->city}}</b></i></h6>
                                </div>
                                {{-- <div class="col-md-1"> --}}
                                {{-- </div> --}}
                                <div class="col-md-4">
                                    <h6>Postcode: <b><i>{{$ovner->postcode}}</b></i></h6>
                                </div>
                            </div>
                            <h6>Country: <b><i>{{$ovner->country}}</b></i></h6>
                        </div>
                    </div>


                    {{-- sekciaj padalinta i dvus pabaiga--}}
                    <div class="col-md-4">
                        <div class="card-body">
                            <h6>Bank: <b><i>{{$ovner->bank}}</b></i></h6>
                            <h6>Account: <b><i>{{$ovner->account}}</b></i></h6>
                        </div>

                        <div class="card-body">
                            <div class="list-table__buttons">
                                {{-- <a href="{{route('ovner-show', $ovner)}}" class="btn btn-info m-2">Show</a> --}}
                                <a href="{{route('ovner-edit', $ovner)}}" class="btn btn-secondary m-2" style="width: 80px;">Edit</a>

                                <form action="{{route('ovner-delete', $ovner)}}" method="post">
                                    <button type="submit" class="btn btn-danger m-2">Delete</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="card shadow bg-body-tertiary rounded d-flex ">
                    <div class="card-header justify-content-md-between align-items-center d-flex">
                        <h1>List empty</h1>
                        <a href="{{route('start')}}" class="btn btn-secondary">BACK</a>
                    </div>
                </div>
            </div>

            @endforelse
        </div>
    </div>
</div>


@endsection
