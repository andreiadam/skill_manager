@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <div>
                            <a href="{{route('create')}}" class="btn btn-primary float-right">Add User</a>
                        </div>


                        You are logged in!
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    User ID
                                </th>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th>
                                <th>
                                    E-mail
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->id}}
                                    </td><td>
                                        {{$user->first_name}}
                                    </td><td>
                                        {{$user->last_name}}
                                    </td><td>
                                        {{$user->email}}
                                    </td><td>
                                        <a href="{{ route('details',$user->id) }}" class="btn btn-info">Detail</a>
                                        <a href="{{ route('edit',$user->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('delete',$user->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
