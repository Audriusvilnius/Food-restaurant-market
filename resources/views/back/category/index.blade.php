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
                    <h1>{{__('Food Categories')  }}</h1>
                    <a href="{{route('category-create')}}" class="btn btn-primary d-flex justify-content-center align-content-center m-2 ">{{__('Add Category')}}</a>
                </div>
            </div>
        </div>
        <section class="py-1 text-center container">
            <div class="col-lg-4 col-md-8 mx-auto mt-1">
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

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-6 g-3">
            @forelse($categories as $category)
            <div id="{{ $category['id'] }}" class="col d-flex justify-content-md-between">
                <div class="card g-0 shadow p-1 bg-body-tertiary rounded">
                    <div class="col-md-12 container_pic">
                        <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">
                        <div class="centered shadow_new justify-content-center">
                            <h1><b><i>
                                        @if (app()->getLocale() == "lt")
                                        {{$category->title_lt}}
                                        @else
                                        {{$category->title_en}}
                                        @endif
                                        {{$category->food_Category()->count()}}</i></b></h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body d-flex justify-content-md-between gap-3">

                            <a href="{{route('category-edit', $category)}}" class="btn btn-secondary "><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg></a>
                            <form action="{{route('category-delete', $category)}}" method="post">
                                <button type="submit" class="btn btn-danger container-fluid"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg></button>
                                @csrf
                                @method('delete')
                            </form>
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
