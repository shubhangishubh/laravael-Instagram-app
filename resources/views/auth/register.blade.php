@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mx-auto my-5" style="width: 32rem;">
                <div class="card-body">
                    <h2 class="display-4  mb-2">Register</h2>
                    {{-- Register Form --}}
                    <form method="post" action="{{route('register')}}">
                        @csrf
                        <div class="form-group py-2">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control @error('fullName') border-danger @enderror" id="fullName" name="fullName" placeholder="Full Name" value="{{old('fullName')}}">

                            @error('fullName')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group py-2">
                            <label for="Email">Email address</label>
                            <input type="email" class="form-control @error('email') border-danger @enderror " id="email" name="email" placeholder="Enter email"
                                value="{{old('email')}}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group py-2">
                            <label for="mobile">Mobile No.</label>
                            <input type="text" class="form-control @error('phone') border-danger @enderror " id="phone" name="phone"
                                placeholder="Enter mobile no." value="{{old('phone')}}">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group py-2">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control @error('password') border-danger @enderror " id="password" name="password"
                                placeholder="Password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group py-2">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') border-danger @enderror" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm Password">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                        <a href="{{route('login')}}" class="float-end">Login to Account</a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection