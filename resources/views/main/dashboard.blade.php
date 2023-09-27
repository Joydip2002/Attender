@include('sidebar.sidebar')
@include('preloader.preloader')
<div id="addAdmin2" class="">
    
</div>
@include('footer.footer')

<script>

    dashboard();

    // function notifications(){
    //      $.ajax({
    //         url: "{{url('/notifiactionsPage')}}",
    //         success:function(data){
    //             $("#addAdmin2").html(data);
    //         }
    //      })
    // }

    function dashboard() {
        $.ajax({
            url: "{{ url('/adminDashboard') }}",
            success: function(data) {
                registrationChart();
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }

    function registrationChart() {
        $.ajax({
            url: "{{ url('/chart') }}",
            type: "GET",
            success: function(data, status) {
                console.log(data);
                var dates = [];
                var counts = [];
                data.forEach(element => {
                    dates.push(element.reg_date);
                    counts.push(element.count);
                });
                // Chart.js configuration
                var ctx = document.getElementById('registrationChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Registration',
                            data: counts,
                            // backgroundColor: 'blue',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: {
                            duration: 100,
                            easing: 'linear',
                            from: 5,
                            to: 0,
                            loop: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "Date"
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: "No of Register"
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });
    }

    function addAdmin() {
        $.ajax({
            url: "{{ url('/addAdmin') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }

    function updateAdminPofile($id){
        // alert($id)
        // $("#updateModal").modal('show');
        var uid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.post('{{url('/showDataUpdateModal')}}', { uid: uid ,  _token: csrfToken}, function (data, status) {
                // var userdetails = JSON.parse(data);
                // console.log(data.adminData.name);
                // updgender = "";
                $("#uname").val(data.adminData.name);
                $("#uemail").val(data.adminData.email);
                $("#uphone").val(data.adminData.phone);
                $("#address").val(data.adminData.address);
                $("#hiddenid").val(data.adminData.id);
                if (data.adminData.gender === 'M') {
                    $('#ugender1').attr('checked', 'checked');
                }
                if (data.adminData.gender === 'F') {
                    $('#ugender2').attr('checked', 'checked');
                }
                $("#hiddenid").val(data.adminData.id);
            })

            $("#updateModal").modal('show');
    }

    function saveChanges(){
        var upgender = "";
            var uname = $("#uname").val();
            var uemail = $("#uemail").val();
            var umobile = $("#uphone").val();
            var address = $("#address").val();
            if ($('#ugender1').is(':checked')) {
                upgender = $('#ugender1').val();
                // console.log(upgender);
            }
            else if ($('#ugender2').is(':checked')) {
                upgender = $('#ugender2').val();
            }
            var uid = $("#hiddenid").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.post("{{url('/updateDetails')}}", { uname: uname, uemail: uemail, umobile: umobile, address:address, upgender: upgender, userid: uid ,_token: csrfToken}, function (data, status) {
                addAdmin();
                // var updateresponse = JSON.parse(data);
                if (data.status == 200) {
                    Swal.fire({
                        position: 'middle-center',
                        icon: 'success',
                        text: data.success,
                        // confirmButtonText: "OK"
                        timer: 2000
                    })
                }
                else {
                    Swal.fire({
                        position: 'middle-center',
                        icon: 'error',
                        text: data.message,
                        // confirmButtonText: "OK"
                    })
                }
            });
            $("#updateModal").modal('hide');
    }



    function addStudent() {
        $.ajax({
            url: "{{ url('/addStudent') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }
    function viewClass() {
        $.ajax({
            url: "{{ url('/viewClass') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }

    function addTeacher() {
        $.ajax({
            url: "{{ url('/addTeacher') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }

    function addClass() {
        $.ajax({
            url: "{{ url('/addClass') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }

    function stuRegisterfunc() {
        // e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var gendertype = $("input[name='gender']:checked").val();
        var semester = $('#semester').val();
        var address = $('#address').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('student-register') }}",
            type: "POST",
            data: {
                name: name,
                email: email,
                phone: phone,
                gendertype: gendertype,
                semester: semester,
                address: address,
                _token: csrfToken
            },
            success: function(data) {
                // console.log(data);
                $("#studentForm")[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: "Student Added Successfully",
                    showConfirmButton: true,
                    timerProgressBar: true,
                })
            },
            error: function(error) {
                errors = error.responseJSON.errors;
                str = "";
                for (e in errors) {
                    str += errors[e][0] + "\n";
                }
                Swal.fire("", "" + str + "", "warning")
            }
        });
    }

    function addSem() {
        var year = $("#year").val();
        var subjectname = $("#subjectname").val();
        var semester = $("#semester").val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('add-classroom') }}",
            type: "POST",
            data: {
                year: year,
                subjectname: subjectname,
                semester: semester,
                _token: csrfToken
            },
            success: function(data) {
                $("#classform")[0].reset();
                Swal.fire({
                    icon: 'success',
                    text: "class added Successfully",
                    showConfirmButton: true,
                    timerProgressBar: true,
                })
            },
            error: function(error) {
                errors = error.responseJSON.errors;
                str = "";
                for (e in errors) {
                    str += errors[e][0] + "\n";
                }
                Swal.fire("", "" + str + "", "warning")
            }
        })
    }

    function grantedTeacher($id) {
        // alert($id);
        var tid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $("#preloader").show();
        $.ajax({
            url: "{{ url('/grantedTeacherPage') }}",
            type: 'POST',
            data: {
                id: tid,
                _token: csrfToken
            },
            success: function(data, status) {
                $("#preloader").hide();
                addTeacher();
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Granted Successfully.'
                    })
                } else {
                    Swal.fire('', '' + data + '', 'info')
                }
            }
        });
    }

    function deniedTeacher($id) {
        // alert($id);
        var tid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('/deniedTeacherPage') }}",
            type: 'POST',
            data: {
                id: tid,
                _token: csrfToken
            },
            success: function(data, status) {
                addTeacher();
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'denied successfully.'
                    })
                } else {
                    Swal.fire('', '' + data + '', 'info')
                }
            }
        });
    }

    function studentGranted($id) {
        var sid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $("#preloader").show();
        $.ajax({
            url: "{{ url('/studentGrantedPage') }}",
            method: "POST",
            data: {
                id: sid,
                _token: csrfToken
            },
            success: function(data, status) {
                $("#preloader").hide();
                addStudent();
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        text: 'granted successful',
                    })
                } else {
                    Swal.fire('', '' + data + '', 'info')
                }
            }
            
        });
    }

    function studentDenied($id) {
        var sid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('/studentDeniedPage') }}",
            method: "POST",
            data: {
                id: sid,
                _token: csrfToken
            },
            success: function(data, status) {
                addStudent();
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        text: 'denied successful',
                    })
                } else {
                    Swal.fire('', '' + data + '', 'info')
                }
            }
        });
    }

    function studentUpdate($id){
        // alert($id)
        // $("#updateModal").modal('show');
        var uid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.post('{{url('/studentDataUpdate')}}', { uid: uid ,  _token: csrfToken}, function (data, status) {
                // var userdetails = JSON.parse(data);
                // console.log(data.adminData.name);
                // updgender = "";
                $("#uname").val(data.studentData.name);
                $("#uemail").val(data.studentData.email);
                $("#uphone").val(data.studentData.phone);
                $("#address").val(data.studentData.address);
                $("#hiddenid").val(data.studentData.id);
                if (data.studentData.gender === 'M') {
                    $('#ugender1').attr('checked', 'checked');
                }
                if (data.studentData.gender === 'F') {
                    $('#ugender2').attr('checked', 'checked');
                }
                $("#hiddenid").val(data.studentData.id);
            })

            $("#updateModal").modal('show');
    }

    function saveChangesStudent(){
        var upgender = "";
            var uname = $("#uname").val();
            var uemail = $("#uemail").val();
            var umobile = $("#uphone").val();
            var address = $("#address").val();
            if ($('#ugender1').is(':checked')) {
                upgender = $('#ugender1').val();
                // console.log(upgender);
            }
            else if ($('#ugender2').is(':checked')) {
                upgender = $('#ugender2').val();
            }
            var uid = $("#hiddenid").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.post("{{url('/updateDetailsStudent')}}", { uname: uname, uemail: uemail, umobile: umobile, address:address, upgender: upgender, userid: uid ,_token: csrfToken}, function (data, status) {
                addStudent();
                // var updateresponse = JSON.parse(data);
                if (data.status == 200) {
                    Swal.fire({
                        position: 'middle-center',
                        icon: 'success',
                        text: data.success,
                        // confirmButtonText: "OK"
                        timer: 2000
                    })
                }
                else {
                    Swal.fire({
                        position: 'middle-center',
                        icon: 'error',
                        text: data.message,
                        // confirmButtonText: "OK"
                    })
                }
            });
            $("#updateModal").modal('hide');
    }

    function teacherUpdate($id){
        // alert($id)
        // $("#updateModal").modal('show');
        var uid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.post('{{url('/studentDataUpdate')}}', { uid: uid ,  _token: csrfToken}, function (data, status) {
                // var userdetails = JSON.parse(data);
                // console.log(data.adminData.name);
                // updgender = "";
                $("#uname").val(data.studentData.name);
                $("#uemail").val(data.studentData.email);
                $("#uphone").val(data.studentData.phone);
                $("#address").val(data.studentData.address);
                $("#hiddenid").val(data.studentData.id);
                if (data.studentData.gender === 'M') {
                    $('#ugender1').attr('checked', 'checked');
                }
                if (data.studentData.gender === 'F') {
                    $('#ugender2').attr('checked', 'checked');
                }
                $("#hiddenid").val(data.studentData.id);
            })

            $("#updateModal").modal('show');
    }

    function saveChangesTeacher(){
        var upgender = "";
            var uname = $("#uname").val();
            var uemail = $("#uemail").val();
            var umobile = $("#uphone").val();
            var address = $("#address").val();
            if ($('#ugender1').is(':checked')) {
                upgender = $('#ugender1').val();
                // console.log(upgender);
            }
            else if ($('#ugender2').is(':checked')) {
                upgender = $('#ugender2').val();
            }
            var uid = $("#hiddenid").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.post("{{url('/updateDetailsStudent')}}", { uname: uname, uemail: uemail, umobile: umobile, address:address, upgender: upgender, userid: uid ,_token: csrfToken}, function (data, status) {
                addTeacher();
                // var updateresponse = JSON.parse(data);
                if (data.status == 200) {
                    Swal.fire({
                        position: 'middle-center',
                        icon: 'success',
                        text: data.success,
                        // confirmButtonText: "OK"
                        timer: 2000
                    })
                }
                else {
                    Swal.fire({
                        position: 'middle-center',
                        icon: 'error',
                        text: data.message,
                        // confirmButtonText: "OK"
                    })
                }
            });
            $("#updateModal").modal('hide');
    }

    function classActive($id) {
        // alert($id);
        var tid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('/classActivePage') }}",
            type: 'POST',
            data: {
                id: tid,
                _token: csrfToken
            },
            success: function(data, status) {
                viewClass();
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'activate successfully.'
                    })
                } else {
                    Swal.fire('', '' + data + '', 'info')
                }
            }
        });
    }

    function classInactive($id) {
        // alert($id);
        var tid = $id;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url('/classInactivePage') }}",
            type: 'POST',
            data: {
                id: tid,
                _token: csrfToken
            },
            success: function(data, status) {
                viewClass();
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'inactivate successfully.'
                    })
                } else {
                    Swal.fire('', '' + data + '', 'info')
                }
            }
        });
    }

</script>

</body>

</html>
