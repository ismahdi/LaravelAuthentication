@extends('layouts.total')

@section('style')
    <style>
        .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(218, 41%, 45%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%);
        }

        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
        }
    </style>
@stop

@section('content')
    <section class="background-radial-gradient overflow-hidden">
        <div>
            <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-3">
                <div class="row gx-lg-5 align-items-center mb-5">
                    <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                            Sign up free <br/>
                            <span style="color: hsl(218, 81%, 75%)">for your business</span>
                        </h1>
                        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Temporibus, expedita iusto veniam atque, magni tempora mollitia
                            dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                            ab ipsum nisi dolorem modi. Quos?
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                        <div class="card bg-glass">
                            <div class="card-body mt-5 px-4 py-2 px-md-5">
                                <form action="{{route('store')}}" method="post">
                                    @csrf
                                    <!-- Name input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="full_name">Full Name</label>
                                        <input type="text" id="full_name"
                                               class="form-control @error('full_name') is-invalid @enderror"
                                               name="full_name" value="{{old('full_name')}}"/>

                                        @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email address</label>
                                        <input type="email" id="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{old('email')}}"/>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"/>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password_confirmation" name="password_confirmation"/>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Submit button -->
                                    <div class="container">
                                        <div class="flex-container " style="display: flex; justify-content: center;">
                                            <button type="submit"
                                                    class="btn btn-primary btn-block mb-4 text-center w-50 mt-2">
                                                Register
                                            </button>
                                        </div>
                                    </div>

                                    <!-- login area -->
                                    <div class="text-center">
                                        <p>Already have an account? <a href="{{route('login')}}"
                                                                       style="color: blue; text-decoration: none">Login </a>
                                        </p>
                                        <button type="button" class="btn btn-link btn-floating mx-1">
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
@endsection
