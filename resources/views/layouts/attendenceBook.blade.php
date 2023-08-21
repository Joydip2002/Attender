<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Attendence Record Book</title>
    @include('header.attendenceheader')
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h3><u>Attendence Book</u></h3>
    </div>
    <div class="conatiner d-flex justify-content-center justify-content-around">

        <div>
            <h6>Name : <span>{{ session('user_name') }}</span></h6>
        </div>

        <form action="" method="" class="d-flex justify-content-around col-8">
            <div class="d-flex">
                <h6>Semester</h6>
                &nbsp;<select name="semester" id="semester">
                    <option value="S-I">S-I</option>
                    <option value="S-II">S-II</option>
                    <option value="S-III">S-III</option>
                    <option value="S-IV">S-IV</option>
                    <option value="S-V">S-V</option>
                    <option value="S-VI">S-VI</option>
                </select>
            </div>

            <div class="d-flex">
                <h6>Subject</h6>
                &nbsp;<select name="subject" id="subject">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->subject }}">{{ $subject->subject }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn btn-primary" onclick="viewStudentRecord()">Submit</button>
        </form>

        <div class="btn btn-danger">
            <a href="{{ url('/teacherLogout') }}" class="text-decoration-none text-white">Logout</a>
        </div>
    </div>
    <hr>

    <div class="container d-flex justify-content-end">
        <button type="submit" class="btn btn-info bs">Bulk Select</button>
        <button class="btn btn-danger mx-1 hidden cb">Cancel Bulk</button>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Semester</th>
                    <th scope="col" class="p">Present</th>
                    <th class="bsc hidden"><input type="checkbox"></th>
                </tr>
            </thead>
            <tbody id="tableBody">
               
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $(".bs").click(function() {
                $(".bs").hide();
                $(".cb").show();
                $('.bsc').show();
                $('.p').hide();
            })
            $(".cb").click(function() {
                $(".bs").show();
                $(".cb").hide();
                $('.bsc').hide();
                $('.p').show();
            })
        })

        function viewStudentRecord() {
            var sem = $("#semester").val();
            var sub = $("#subject").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('/studentView') }}",
                type: "POST",
                data: {
                    sem: sem,
                    sub: sub,
                    _token: csrfToken
                },
                success: function(data) {
                  $("#tableBody").html(data);
                    console.log("success");
                }
            })
        }
    </script>
    @include('footer.footer')
</body>

</html>
