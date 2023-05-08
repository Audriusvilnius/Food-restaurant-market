@extends('layouts.app')
@section('content')
@include('alerts.alert')

<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up sticky-bottom">
        <i class="bi bi-chevron-up"></i>
    </div>
</a>
<div class="container mb-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between align-content-between d-flex ">
                    <h1>{{__('Food list')  }}</h1>
                    <a href="{{route('foods-create')}}" class="btn btn-primary d-flex justify-content-center align-content-center m-2 ">{{__('Add new') }}</a>
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
                            @if (app()->getLocale() == "lt")
                            <h6>{{__('Food') }}: <b><i>{{$food->title_lt}}</b></i></h6>
                            @else
                            <h6>{{__('Food') }}: <b><i>{{$food->title_en}}</b></i></h6>
                            @endif
                            <h6>{{__('Price') }}: <b><i>{{$food->price}} &euro;</b></i></h6>
                            <h6>{{__('Rating') }}: <b><i>{{$food->rating}}</b></i></h6>
                            <h6>{{__('Voted') }}: <b><i>{{$food->counts}}</b></i></h6>
                            <h6>{{__('City') }}: <b><i>{{$food->foodCities_no->title}}</b></i></h6>
                            @if (app()->getLocale() == "lt")
                            <h6>{{__('Category') }}: <b><i>{{$food->foodCategory_no->title_lt}}</b></i></h6>
                            @else
                            <h6>{{__('Category') }}: <b><i>{{$food->foodCategory_no->title_en}}</b></i></h6>
                            @endif
                            <hr class="border border-second border-2 opacity-50">

                            <h6>{{__('Restaurant') }}: <b><i>{{$food->foodReataurants_name->title}}</b></i></h6>
                            <div class="col-md-12 d-flex">
                                <div class="col-md-6">
                                    <h6>{{__('Open') }}: <b><i>{{$food->foodReataurants_name->open}}</b></i></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>{{__('Close') }}: <b><i>{{$food->foodReataurants_name->close}}</b></i></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- sekciaj padalinta i dvus pabaiga--}}
                    <div class="col-md-4">
                        <div class="card-body">
                            <h6 class="card-title text-muted">{{__('Additional info')  }}:</h6>
                            <p class="card-text"><small class="text-muted">{{$food->add}}</small></p>
                            <h6 class="card-title">{{__('Description') }}:</h6>
                            @if (app()->getLocale() == "lt")
                            <textarea class="form-control" placeholder="{{$food->des_lt}}" rows="3" cols="auto"></textarea>
                            @else
                            <textarea class="form-control" placeholder="{{$food->des_en}}" rows="3" cols="auto"></textarea>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="list-table__buttons gap-3">
                                <a href="{{route('foods-edit', $food)}}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>

                                <form action="{{route('foods-delete', $food)}}" method="post">
                                    <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg></button>

                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <h2 class="list-group-item">{{__('No types yet')  }}</h2>
            @endforelse
        </div>
    </div>
</div>


@endsection
