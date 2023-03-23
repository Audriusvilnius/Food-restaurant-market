@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>Ovner edit</h1>
                </div>
            </div>
            @if($errors)
            @foreach ($errors->all() as $message)
            <h6 class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </h6>
            @endforeach
            @endif

            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            <form action="{{route('ovner-update',$ovner)}}" method="post" enctype="multipart/form-data">

                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-3">
                            <div class="card-body">
                                Title
                                <input type="text" class="form-control" name="ovner_title" value="{{old('ovner_title',$ovner->title)}}">

                                <div class="col-md-12 d-flex">
                                    <div class="col-md-7">
                                        Street
                                        <input type="text" class="form-control" name="ovner_street" value="{{old('ovner_street',$ovner->street)}}">
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-4">
                                        Build
                                        <input type="text" class="form-control" name="ovner_build" value="{{old('ovner_build',$ovner->build)}}">
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex">
                                    <div class="col-md-7">
                                        City
                                        <input type="text" class="form-control" name="ovner_city" value="{{old('ovner_city',$ovner->city)}}">

                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-4">
                                        Postcode
                                        <input type="text" class="form-control" name="ovner_postcode" value="{{old('ovner_postcode',$ovner->postcode)}}">

                                    </div>
                                </div>
                                Country
                                <input type="text" class="form-control" name="ovner_country" value="{{old('ovner_country',$ovner->country)}}">

                                Bank
                                <input type="text" class="form-control" name="ovner_bank" value="{{old('ovner_bank',$ovner->bank)}}">

                                Account
                                <input type="text" class="form-control" name="ovner_account" value="{{old('ovner_account',$ovner->account)}}">


                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card-body">
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-5">
                                        Open
                                        <input type="time" class="form-control" name="ovner_open" value="{{old('ovner_open',$ovner->open)}}">

                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-5">
                                        Close
                                        <input type="time" class="form-control" name="ovner_close" value="{{old('ovner_close',$ovner->close)}}">
                                    </div>
                                </div>
                                Phone
                                <input type="text" class="form-control" name="ovner_phone" value="{{old('ovner_phone',$ovner->phone)}}">

                                Mobile
                                <input type="text" class="form-control" name="ovner_mobile" value="{{old('ovner_mobile',$ovner->mobile)}}">

                                Email
                                <input type="text" class="form-control" name="ovner_email" value="{{old('ovner_email',$ovner->email)}}">

                                URL
                                <input type="text" class="form-control" name="ovner_url" value="{{old('ovner_url',$ovner->url)}}">

                                Additional info
                                <input type="text" class="form-control" name="ovner_add" value="{{old('ovner_add',$ovner->add)}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="col-md-12 d-flex">
                                    <div class="col-md-5">
                                        Photo edit
                                        <img src="{{asset($ovner->photo)}}" class="img-fluid rounded" alt="imageset">
                                        <input type="file" class="form-control mt-3" name="photo">


                                        <button type="submit" class="btn btn-danger float-end mt-3" name="delete_photo" value="1">Delete photo</button>

                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-6 ">
                                        Description
                                        <textarea class="form-control" placeholder="Company description leave a comment here" name="ovner_des" rows="11" cols="50" value="{{old('ovner_des')}}">{{$ovner->des}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <button type="submit" class="btn btn-primary d-flex align-content-end float-end">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @csrf
        @method('put')
        </form>
    </div>
</div>
</div>
@endsection
