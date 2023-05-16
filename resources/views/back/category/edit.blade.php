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
<div class="container pt-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-header justify-content-center">
                <h1>{{__('Edit Food Category')  }}</h1>
            </div>
            <form action="{{route('category-update',$category)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2">
                    <div class="row g-0 shadow bg-body-tertiary rounded align-content-center">
                        <div class="col-md-12">
                            <section class="py-1 text-center container">
                                <div class="col-md-6 mt-3 shadow bg-body-tertiary rounded">
                                    @if(Session::has('ok'))
                                    <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                                    @endif
                                </div>
                                @if($errors)
                                @foreach ($errors->all() as $message)
                                <h6 class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </h6>
                                @endforeach
                                @endif
                            </section>


                            <div class="card-body d-flex">
                                <label for="category_title_en" class="mx-2 text-secondary">EN</label>
                                <input type="text" class="form-control" name="category_title_en" value="{{old('category_title_en', $category->title_en)}}">
                            </div>
                            <div class="card-body d-flex">
                                <label for="category_title_lt" class="mx-2 text-secondary">LT</label>
                                <input type="text" class="form-control" name="category_title_lt" value="{{old('category_title_lt', $category->title_lt)}}">
                            </div>
                            <div class="card-body">
                                <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">
                                <input type="file" class="form-control mt-3" name="photo">
                            </div>
                            <div class="card-body">
                                <div class="list-table__buttons">
                                    <button type="submit" class="btn btn-danger" name="delete_photo" value="1">{{__('Delete photo')  }}</button>
                                    <button type="submit" class="btn btn-primary d-flex align-content-end ms-2" style="width: 80px;" name="save">{{__('Update') }}</button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('put')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
