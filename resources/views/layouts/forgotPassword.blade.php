<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <style>
        body {
            background: url('forgot.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            /* background-position: center; */
        }

        .forgotcard {
            position: relative;
            backdrop-filter: blur(13px) saturate(200%);
            -webkit-backdrop-filter: blur(13px) saturate(200%);
            background-color: rgba(17, 25, 40, 0);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.125);
            z-index: 100;
        }
    </style>
    @include('header.attendenceheader')
</head>

<body class="">
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="px-5 py-3 rounded-3 forgotcard">
            @if (session('failed'))
                <div class="text-danger alert alert-danger">{{ session('failed') }}</div>
            @endif
            <h5>Forgot Password</h5>
            <form action="{{ url('/forgotPassword') }}" class="form-group" method="POST">
                @csrf
                <label for="">Email</label>
                <input type="email" placeholder="Enter Your Email" name="email" class="form-control">
                <span>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </span>
                <button class="btn btn-success w-100 mt-3">Reset Password</button>
                <div class="text-center mt-3">
                    <a href="{{ url('/') }}" class="text-decoration-none text-dark">Don't want to forgot password?&nbsp;<span class="text-danger"><strong>Login</strong></span></a>
                </div>
            </form>
        </div>
    </div>
    @include('footer.footer')
</body>

</html>
