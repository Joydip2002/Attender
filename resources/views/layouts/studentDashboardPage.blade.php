<div class="container d-flex flex-wrap row g-3 my-2">
    <div class="col-md-4">
        <div class="p-3 c1 shadow-lg  rounded d-flex gap-3 flex-wrap">
            <div class="d-flex justify-content-center align-items-center">
                <i class="card p-3 fa-solid fa-users fs-2"></i>
            </div>
            <div>
                <p class="fs-2">Total Present</p>
                <h4 class="fs-5">{{ $totalPresent }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 c2 shadow-lg d-flex gap-3 flex-wrap rounded">
            <div class="d-flex justify-content-center align-items-center">
                <i class="card p-3 fa-solid fa-person-chalkboard fs-2"></i>
            </div>
            <div>
                <p class="fs-2">Total Absent</p>
                <h4 class="fs-5">{{ $absent }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 c3 shadow-lg d-flex gap-3 flex-wrap rounded">
            <div class="d-flex justify-content-center align-items-center">
                <i class="card p-3 fa-solid fa-building-user fs-2"></i>
            </div>
            <div>
                <p class="fs-2">Percentage</p>
                <h4 class="fs-5">{{ $percentage }}%</h4>
            </div>
        </div>
    </div>
</div>

{{-- <nav class="d-flex">
    <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
            role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
            role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div> --}}
<div class="container card col-10">
    <h5 class="card-title">Present/Absent Chart</h5>
    <canvas id="registrationChart" height="30%" width="75%"></canvas>
</div>


<script>
    function registrationChartStudent() {
        var counts = {{ $totalPresent }}
        var dates = {{ $absent }}
        // Chart.js configuration
        var ctx = document.getElementById('registrationChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['present', 'absent'],
                datasets: [{
                    label: 'No of Absent and Present',
                    data: [counts, dates],
                    backgroundColor: ['green', 'yellow'],
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
                            // labelString: "Date"
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Total No of Absent and Present"
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }
</script>
