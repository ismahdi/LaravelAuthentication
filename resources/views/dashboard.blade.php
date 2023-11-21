@extends('layouts.total')


@section('style')
    <style>
        .background-radial-gradient {
            height: 100vh !important;
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
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5" style="height: 65vh">
            <div class="col-md-8">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="d-flex justify-content-center">
                                <img alt="dashboard" src="/image/dashboard.jpg" class="img-fluid"
                                     style="height: 245px;width: 245px;">
                            </div>
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <p class="text-center text-success">
                                        {{ $message }}
                                    </p>
                                @else
                                    <p class="text-center text-success">
                                        You are logged in!
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
