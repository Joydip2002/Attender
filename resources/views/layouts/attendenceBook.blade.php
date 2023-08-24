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
    <div class="container shadow-lg p-3">
        <div class="d-flex justify-content-center justify-content-md-between">
            <div>
                <h6>Name: <span>{{ session('user_name') }}</span></h6>
            </div>
            <div class="btn btn-sm btn-danger">
                <a href="{{ url('/teacherLogout') }}" class="text-decoration-none text-white">Logout</a>
            </div>
        </div>
    
        <form action="" method="" class="d-flex flex-wrap justify-content-around col-12 col-md-8">
            <div class="d-flex flex-column mb-3">
                <label for="semester" class="form-label">Semester</label>
                <select name="semester" id="semester" class="form-select">
                    @foreach ($subjects->unique('semestername') as $subject)
                        <option value="{{ $subject->semestername }}">{{ $subject->semestername }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="d-flex flex-column mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select name="subject" id="subject" class="form-select">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->subject }}">{{ $subject->subject }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="d-flex flex-column mb-3">
                <label for="year" class="form-label">Batch Year</label>
                <select name="year" id="year" class="form-select">
                    @foreach ($subjects->unique('semesteryear') as $year)
                        <option value="{{ $year->semesteryear }}">{{ $year->semesteryear }}</option>
                    @endforeach
                </select>
            </div>
    
            <button type="button" class="btn btn-primary" id="subbtn" onclick="viewStudentRecord()" style="margin: 30px 0">Submit</button>
        </form>
    </div>
    
    <hr>

    {{-- <div class="container text-center hidden acclass">
        <div class="btn btn-outline-info">Activate Class</div>
    </div> --}}

        <div class="container d-flex justify-content-end my-1">
            <button type="button" class="btn btn-info bs">Bulk Select</button>
            <button type="button" class="btn btn-success sr saveRecord mx-2">Save Recorde</button>
            <button class="btn btn-danger mx-1 hidden cb">Cancel Bulk</button>
        </div>

        <div class="container card">
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">Id</th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Semester</th>
                        <th scope="col" class="p"><span class="hidepresent">Present</span>
                            <input type="checkbox" class="bsc hidden" id="allSelect">
                        </th>

                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>


    <script>
        $(document).ready(function() {
            
            // $("#subbtn").click(function() {
            //     $(".acclass").show();
            //     $(".attedencePage").hide();
            // })
            // $(".acclass").click(function() {
            //     $(".attedencePage").show();
            //     $(".acclass").hide();
            // })
            $(".bs").click(function() {
                $(".bs").hide();
                $(".cb").show();
                $('.bsc').show();
                $('.hidepresent').hide();
                // $('.sr').show();
            })
            $(".cb").click(function() {
                $(".bs").show();
                $(".cb").hide();
                $('.bsc').hide();
                $('.hidepresent').show();
                // $('.sr').hide();
            })
            // updateClassStatus();
        })

        // function updateClassStatus() {
        //         var sub = $("#subject").val();
        //             console.log(sub);
        //         // AJAX request to update class status
        //         $.ajax({
        //             url: "{{url('/updateClassStatusDaily')}}", 
        //             type: 'POST',
        //             success: function(response) {
        //                 console.log('Class status updated successfully.');
        //             },
        //             error: function(error) {
        //                 console.error('Error updating class status:', error);
        //             }
        //         });
        //     }
        // updateClassStatus();

        // $(".acclass").click(function() {
        //     var sub = $("#subject").val();
        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     // alert(sub)
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: 'You won\'t be able to revert this!',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Activate!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: "{{ url('/updateClass') }}",
        //                 data: {
        //                     sub,
        //                     sub,
        //                     _token: csrfToken
        //                 },
        //                 type: "get",
        //                 success: function(data, status) {
        //                     console.log('success');
        //                 }
        //             })
        //         }
        //     });
        // })

        function viewStudentRecord() {
            var sem = $("#semester").val();
            var sub = $("#subject").val();
            var year = $("#year").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('/studentView') }}",
                type: "POST",
                data: {
                    sem: sem,
                    sub: sub,
                    year: year,
                    _token: csrfToken
                },
                success: function(data) {
                    $("#tableBody").html(data);
                    // console.log("success");
                    if (!data) {
                        Swal.fire({
                            icon: 'error',
                            title: "No Records Found!",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    if(data.alreadypresent){
                        Swal.fire({
                            icon: 'error',
                            title: "Already Attendence Recorded!!",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            })
        }

        // bulk select
        $("#allSelect").click(function() {
            $(".scheckbox").prop('checked', $(this).prop('checked'));
        });

        $(".saveRecord").click(function(e) {
            e.preventDefault();
            var pArr = [];
            $('input:checkbox[name=id]:checked').each(function() {
                pArr.push($(this).val());
                console.log(pArr);
            });

            if (pArr.length > 0) {
                var sub = $("#subject").val();
                $.ajax({
                    url: "{{ url('/studentAttendenceRecord') }}",
                    type: "get",
                    data: {
                        stuArr: pArr
                    },
                    success: function(data, status) {
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                text: 'response recorded!!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(() => {
                                window.location.href = "{{ 'attendenceBook' }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                text: 'something went wrong',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    }
                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    text: 'select atleast one data',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        })
    </script>
    @include('footer.footer')
</body>

</html>
