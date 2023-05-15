@extends('layouts.app')
@section('content')
<div class="container mb-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between mb-2">
                    <div class="pull-left">
                        <h2>Users Management</h2>
                    </div>
                    @if(Auth::user()->role == 'admin')
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                    </div>
                    @endif
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>Build</th>
                    <th>Postcode</th>
                    <th>Phone</th>
                    @if(Auth::user()->role != 'customer')
                    <th>Restaurant</th>
                    <th>Role</th>
                    @endif
                    <th>Action</th>
                </tr>
                @if(Auth::user()->role == 'user')
                @foreach ($data as $key => $user)
                @if( Auth::user()->id == $user->id)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!empty($user->user_City->title))
                        {{ $user->user_City->title }}
                        @else <span class="badge rounded-pill bg-info fw-lighter text-capitalize fs-6">None<span>
                                @endif
                    </td>
                    <td>{{ $user->street}}</td>
                    <td>{{ $user->build}}</td>
                    <td>{{ $user->postcode}}</td>
                    <td>{{ $user->phone}}</td>
                    <td>
                        @if(!empty($user->user_Restaurants->title))
                        {{ $user->user_Restaurants->title }}
                        @else <span class="badge rounded-pill bg-info bg-primary fw-lighter text-capitalize fs-6">None<span>
                                @endif
                    </td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <span class="badge rounded-pill bg-dark text-capitalize fs-6">{{ $v }}</span>
                        @endforeach
                        @endif
                    </td>
                    <td class="d-flex justify-content-end">
                        <a class="btn btn-info me-1" href="{{ route('users.show',$user->id) }}">Show</a>
                        <a class="btn btn-primary me-1" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endif
                @endforeach
                @endif
                @if(Auth::user()->role == 'customer')
                @foreach ($data as $key => $user)
                @if( Auth::user()->id == $user->id)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    {{-- <td>{{ $user->city_id }}</td> --}}
                    <td>
                        @if(!empty($user->user_City->title))
                        {{ $user->user_City->title }}
                        @else <span class="badge rounded-pill bg-info fw-lighter text-capitalize fs-6">None<span>
                                @endif
                    </td>
                    <td>{{ $user->street}}</td>
                    <td>{{ $user->build}}</td>
                    <td>{{ $user->postcode}}</td>
                    <td>{{ $user->phone}}</td>
                    {{-- <td>
                                @if(!empty($user->user_Restaurants->title))
                                {{ $user->user_Restaurants->title }}
                    @else <span class="badge rounded-pill bg-info fw-lighter text-capitalize fs-6">None<span>
                            @endif
                            </td> --}}
                            {{-- <td>
                                @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <span class="badge rounded-pill bg-dark text-capitalize fs-6">{{ $v }}</span>
                        @endforeach
                        @endif
                        </td> --}}
                        <td class="d-flex justify-content-end">
                            <a class="btn btn-info me-1" href="{{ route('users.show',$user->id) }}">Show</a>
                            <a class="btn btn-primary me-1" href="{{ route('users.edit',$user->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                </tr>
                @endif
                @endforeach
                @endif
                @if(Auth::user()->role == 'admin')
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    {{-- <td>{{ $user->city_id }}</td> --}}
                    <td>
                        @if(!empty($user->user_City->title))
                        {{ $user->user_City->title }}
                        @else <span class="badge rounded-pill bg-info fw-lighter text-capitalize fs-6">None<span>
                                @endif
                    </td>
                    <td>{{ $user->street}}</td>
                    <td>{{ $user->build}}</td>
                    <td>{{ $user->postcode}}</td>
                    <td>{{ $user->phone}}</td>
                    <td>
                        @if(!empty($user->user_Restaurants->title))
                        {{ $user->user_Restaurants->title }}
                        @else <span class="badge rounded-pill bg-info fw-lighter text-capitalize fs-6">None<span>
                                @endif
                    </td>
                    <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <span class="badge rounded-pill bg-dark text-capitalize fs-6">{{ $v }}</span>
                        @endforeach
                        @endif
                    </td>
                    <td class="d-flex justify-content-end">
                        <a class="btn btn-info me-1" href="{{ route('users.show',$user->id) }}">Show</a>
                        <a class="btn btn-primary me-1" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
            <div class="m-4">
                @if(Auth::user()->role == 'admin')
                {!! $data->render() !!}
                @endif
            </div>
        </div>
    </div>
</div>



@endsection
