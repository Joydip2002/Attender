@include('sidebar.sidebar')
<div id="addAdmin2" class="">
</div>
@include('footer.footer')

<script>
    dashboard();

    function addAdmin() {
        $.ajax({
            url: "{{ url('/addAdmin') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
    }

    function dashboard() {
        $.ajax({
            url: "{{ url('/adminDashboard') }}",
            success: function(data) {
                $("#addAdmin2").html(data);
                // $(".adminDashboard").hide();
            }
        })
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
                    icon:'success',
                    text:"class added Successfully",
                    showConfirmButton: true,
                    timerProgressBar: true,               
                })
            },
            error:function(error){
                errors = error.responseJSON.errors;
                str = "";
                for (e in errors) {
                    str += errors[e][0] + "\n";
                }
                Swal.fire("", "" + str + "", "warning")
            }
        })
    }
</script>

</body>

</html>
