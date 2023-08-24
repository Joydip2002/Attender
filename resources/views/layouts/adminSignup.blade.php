<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    @include('header.header')
</head>

<body>
    <div class="container d-flex justify-content-center col-4 flex-column flex-wrap shadow-lg rounded-1 py-3 my-2">
        <div class="container d-flex justify-content-center flex-column col-10">
            <h4>Register Form</h4>
        </div>
        <form action="{{ url('/signup') }}" method="post"
            class="container d-flex justify-content-center flex-column col-10">
            @csrf
            <select name="role" id="role" class="form-control">
                <option value="">Select Role</option>
                {{-- <option value="admin">Admin</option> --}}
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                {{-- <option value="admin">Admin</option> --}}
            </select>
            <span>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>

            <label for="">Name</label>
            <input type="text" name="name" id="" class="form-control" placeholder="Enter Your Name">
            <span>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </span>

            <label for="">Gender</label>
            <div class="d-flex">
                <input type="radio" name="gender" id="male" value="M"><label
                    for="male">Male</label>&nbsp;
                <input type="radio" name="gender" id="female" value="F"><label for="female">Female</label>
            </div>
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label for="">Email</label>
            <input type="email" name="email" id="" class="form-control" placeholder="Enter Your Email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="">Phone</label>
            <input type="tel" name="phone" id="" class="form-control" placeholder="Enter Phone No">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="">Address</label>
            <input type="text" name="address" id="" class="form-control" placeholder="Enter Address">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="" class="extraInputContainer" style="display: none">Choose Semester</label>
            <select name="semester" id="semester" class="extraInputContainer form-control" style="display: none">
                <option value="">Select Semester</option>
                <option value="S-I">S-I</option>
                <option value="S-II">S-II</option>
                <option value="S-III">S-III</option>
                <option value="S-IV">S-IV</option>
                <option value="S-V">S-V</option>
                <option value="S-VI">S-VI</option>
            </select>
            @error('semester')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="" class="" style="">Choose Your Subject</label>
            <select name="subject" id="subject" class=" form-control">
                <option value="">Select Subject</option>
                @foreach ($subjects as $sub)
                    <option value="{{$sub->id}}">{{$sub->subject}}</option>
                @endforeach
            </select>
            @error('subject')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="">Password</label>
            <input type="password" name="password" id="" class="form-control" placeholder="Enter Password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="">Confirm Password</label>
            <input type="password" name="cpassword" id="" class="form-control"
                placeholder="Enter Confirm Password">
            @error('cpassword')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
            <div class="text-center">
                <label for="" class="mt-3">Already have an account?</label><span>&nbsp;<a
                        href="{{ url('/') }}" class="text-danger">Login</a></span>
            </div>
        </form>

        <div class="d-flex justify-content-center mt-2 gap-2">
            <box-icon type='logo' name='google' class="rounded-circle google"></box-icon>
            <box-icon type='logo' name='facebook' class="rounded-circle facebook"></box-icon>
            <box-icon type='logo' name='twitter' class="rounded-circle twitter"></box-icon>
        </div>
    </div>

    @include('footer.footer')
    <script>
        $(document).ready(function() {
            $("#role").change(function() {
                var selectedOption = $(this).val();
                if (selectedOption === "student") {
                    $(".extraInputContainer").show();
                } else {
                    $(".extraInputContainer").hide();
                }
            });
        })
    </script>
</body>

</html>
