@extends('layouts.app')
@section('content')
<div class="container pt-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class="pull-left">
                        <h2>{{__('Edit User data')}}</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> {{__('Back')}}</a>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card mt-2 d-flex justify-content-md-between">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Name')}}:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Email')}}:</strong>

                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Password')}}:</strong>
                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Confirm Password')}}:</strong>
                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Phone')}}:</strong>
                                {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('City')}}:</strong>
                                <select class="form-select" name="city_id">
                                    <option value="{{null}}">{{__('Nėra')}}</option>
                                    @foreach($cites as $city)
                                    <option value="{{$city->id}}" @if($city->id == old('city_id',$user->city_id)) selected @endif>{{$city->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Street')}}:</strong>
                                {!! Form::text('street', null, array('placeholder' => 'Street','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Build')}}:</strong>
                                {!! Form::text('build', null, array('placeholder' => 'Build','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Postcode')}}:</strong>
                                {!! Form::text('postcode', null, array('placeholder' => 'Postcode','class' => 'form-control')) !!}
                            </div>
                        </div>
                        @if(Auth::user()?->role == 'admin')
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Restaurant')}}:</strong>
                                <select class="form-select" name="rest_id">
                                    <option value="{{null}}">{{__('Nėra')}}</option>
                                    @foreach($rest_id as $restaurant)
                                    <option value="{{$restaurant->id}}" @if($restaurant->id == old('rest_id',$user->rest_id)) selected @endif>{{$restaurant->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Role')}}:</strong>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()?->role != 'admin')
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <input type="hidden" name="rest_id" value="{{ $user->rest_id }}">
                        @endif
                        <div class=" col-xs-12 col-sm-12 col-md-12 text-center mt-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
