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
<div class="container mb-5" style="min-height: 850px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h1>Edit Food Catagories</h1>
                </div>
            </div>
            <form action="{{route('category-update',$category)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2">
                    <div class="row g-0 shadow bg-body-tertiary rounded align-content-center">
                        <div class="col-md-12">
                            <div class="card-body d-flex">
                                <input type="text" class="form-control" name="category_title" value="{{old('category_title',$category->title)}}">
                            </div>
                            <div class="card-body">
                                <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">
                                <input type="file" class="form-control mt-3" name="photo">
                            </div>
                            <div class="card-body">
                                <div class="list-table__buttons">
                                    <button type="submit" class="btn btn-danger" name="delete_photo" value="1">Delete photo</button>
                                    <button type="submit" class="btn btn-primary d-flex align-content-end ms-2" style="width: 80px;" name="save">Update</button>
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