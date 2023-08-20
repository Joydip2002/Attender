@include('sidebar.studentsidebar')
<div id="studentMainContentLoad">

</div>
@include('footer.footer')

<script>
    stuDashboard();
    function stuDashboard() {
            $.ajax({
                url: "{{ url('/studentDashboardPage') }}",
                success: function(data) {
                    // console.log(data);
                    $("#studentMainContentLoad").html(data);
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
