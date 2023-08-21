<script>
    $.ajax({
            url : "{{url('/chart')}}",
            type:"GET",
            success:function(data,status){
                // console.log(results);
                var dates = Object.keys(data);
                var counts = Object.values(data);
            // Chart.js configuration
            var ctx = document.getElementById('registrationChart').getContext('2d');
            var chart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: dates,
                datasets: [{
                  label: 'Registration',
                  data: counts,
                  backgroundColor: 'blue',
                  borderColor: 'rgba(0, 123, 255, 1)',
                  borderWidth: 1
                }]
              },
              options: {
                responsive: true,
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
                    }
                  }]
                }
              }
            });
            }
        });
</script>