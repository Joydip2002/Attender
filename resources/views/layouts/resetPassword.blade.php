<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
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
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="forgotcard shadow-lg px-5 py-3 rounded-3">
            <h5>Reset Password</h5>
            <form action="{{ url('/resetPasswordPage') }}/{{ $id }}" class="form-group" method="POST">
                @csrf
                <label for="">Password</label>
                <input type="password" placeholder="Enter Password" name="password" class="form-control">
                <span>
                    @error('cpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </span>
                <label for="">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="cpassword" class="form-control">
                <span>
                    @error('cpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </span>
                <button class="btn btn-outline-success w-100 mt-3">Reset Password</button>
            </form>
        </div>
    </div>
    @include('footer.footer')
</body>

</html>
