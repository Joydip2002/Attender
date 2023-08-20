<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    @include('header.header')
</head>
<body>
    <div class="container d-flex flex-wrap">
        <div class="">
            <img src="login2.png" alt="">
        </div>
        <div class="d-flex justify-content-center flex-column align-items-center col-3 shadow-lg p-4 rounded-2">
            @if (session('success'))
                <div class="text-success">{{session('success')}}</div>
            @endif
            @if (session('failed'))
                <div class="text-danger">{{session('failed')}}</div>
            @endif
            <form action="{{url('/login')}}" method="post" class="col-12">
                @csrf
                <label for="">User Role</label>
                <input type="text" name="type" class="form-control" placeholder="Automatically Fetch Your Role" id="urole" readonly>
                <label for="">Username(Email)</label>
                <input type="email" name="email" id="" class="form-control" placeholder="Enter Username" id="email" onchange="fetchRole(this.value)">
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                <label for="Password">Password</label>
                <input type="password" name="password" id="" class="form-control" placeholder="Enter Password">
                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                <div class="d-flex justify-content-end">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                <div class="text-center">
                    <label for="" class="mt-3">Don't have an account?</label><span>&nbsp;<a href="{{url('/signup')}}" class="text-danger">Register</a></span>
                </div>
            </form>
             
            <div class="mt-2 d-flex gap-3">
                <box-icon type='logo' name='google' class="rounded-circle google"></box-icon>
                <box-icon type='logo' name='facebook' class="rounded-circle facebook"></box-icon>
                <box-icon type='logo' name='twitter' class="rounded-circle twitter"></box-icon>
            </div>
        </div>
        
    </div>

    @include('footer.footer')

    <script>
        function fetchRole(email){
            $.ajax({
                url:"{{route('role-fetch')}}",
                type:"GET",
                data : {email :email},
                success: function(data,status){
                    var role = data.role; 
                    console.log(role); 
                    $("#urole").val(role);
                },
                error : function(xhr,status,error){
                    console.error(xhr.status);
                }
            })
        }
    </script>
</body>
</html>