{{--EDIT PAGE--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Details</div>

                    <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input disabled value="{{ $user->first_name }}" type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input disabled value="{{ $user->last_name }}" type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
                                </div>
                            </div><div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input disabled value="{{ $user->email }}" type="email" class="form-control" id="email" placeholder="Email" name="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input disabled type="password" class="form-control" id="password" placeholder="Password" name="password">
                                </div>
                            </div>

                        <div>
                            @include('inc.chart')
                        </div>
                        {{--<pre>--}}
                            {{--{{json_encode($user, JSON_PRETTY_PRINT) }}--}}
                        {{--</pre>--}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
