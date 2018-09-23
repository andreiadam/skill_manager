@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create User</div>

                    <div class="card-body">
                        <form method="post" action="{{route('store')}}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
                                </div>
                            </div><div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                </div>
                            </div>

                            @include('inc.addskills')

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
