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
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                    </div>
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
                    <th>Rest</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->street}}</td>
                    <td>{{ $user->build}}</td>
                    <td>{{ $user->postcode}}</td>
                    <td>{{ $user->street}}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->rest_id }}</td>
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
            </table>
            {!! $data->render() !!}
        </div>
    </div>
</div>
@endsection
