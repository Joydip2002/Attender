<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendence Record Book</title>
    @include('header.attendenceheader')
    <style>
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h3><u>Attendence Khata</u></h3>
    </div>
    <div class="conatiner d-flex justify-content-center justify-content-around">

        <div>
            <h6>Name : <span>Joydip Manna</span></h6>
        </div>

        <div class="d-flex">
           <h6>Semester</h6>
           &nbsp;<select name="" id="">
                <option value="">S-I</option>
                <option value="">S-II</option>
                <option value="">S-III</option>
            </select>
        </div>

        <div class="d-flex">
          <h6>Subject</h6>
          &nbsp;<select name="" id="">
                <option value="">Physics</option>
                <option value="">Math</option>
                <option value="">Geography</option>
            </select>
        </div>

        <div class="btn btn-danger">
          <a href="{{url('/teacherLogout')}}" class="text-decoration-none text-white">Logout</a>
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
                <th scope="col">Student_Id</th>
                <th scope="col">Name</th>
                <th scope="col">Semester</th>
                <th scope="col" class="p">Present</th>
                <th class="bsc hidden"><input type="checkbox"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>1</th>
                <td>Mark</td>
                <td>S-II</td>
                <td class="p"><input type="checkbox" name="" id=""></td>
                <td class="bsc hidden"><input type="checkbox" name="" id=""></td>
              </tr>
              <tr>
                <th>2</th>
                <td>Jacob</td>
                <td>S-II</td>
                <td class="p"><input type="checkbox" name="" id=""></td>
                <td class="bsc hidden"><input type="checkbox" name="" id=""></td>
              </tr>
              <tr>
                <th>3</th>
                <td>Larry the Bird</td>
                <td>S-II</td>
                <td class="p"><input type="checkbox" name="" id=""></td>
                <td class="bsc hidden"><input type="checkbox" name="" id=""></td>
              </tr>
            </tbody>
          </table>
    </div>
    <script>
       $(document).ready(function(){
        $(".bs").click(function(){
            $(".bs").hide();
            $(".cb").show();
            $('.bsc').show();
            $('.p').hide();
        })
        $(".cb").click(function(){
            $(".bs").show();
            $(".cb").hide();
            $('.bsc').hide();
            $('.p').show();
        })
       })
    </script>
    @include('footer.footer')
</body>
</html>