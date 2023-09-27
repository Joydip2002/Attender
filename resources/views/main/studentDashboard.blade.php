@include('sidebar.studentsidebar')
<div id="studentMainContentLoad">

</div>
@include('footer.footer')

<script>
    stuDashboard();

    function stuDashboard() {
        $.ajax({
            url: "{{ url('/studentDashboardPage') }}",
            data: {
                id: {{ session('user_id') }}
            },
            success: function(data) {
                // console.log(data);              
                $("#studentMainContentLoad").html(data);               
                registrationChartStudent();
            }
        })
    }

    function studentReport() {
        $.ajax({
            url: "{{ url('/studentReport') }}",
            success: function(data) {
                // console.log(data);
                $("#studentMainContentLoad").html(data);
            }
        })
    }

</script>
