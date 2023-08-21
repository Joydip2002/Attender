<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container d-flex flex-wrap row g-3 my-2">
    <div class="col-md-4">
        <div class="p-3 c1 shadow-lg  rounded d-flex gap-3 flex-wrap">
            <div class="d-flex justify-content-center align-items-center">
                <i class="card p-3 fa-solid fa-users fs-2"></i>
            </div>
            <div>
                <p class="fs-2">Total Students</p>
                <h4 class="fs-5">{{ $totalStudent }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 c2 shadow-lg d-flex gap-3 flex-wrap rounded">
            <div class="d-flex justify-content-center align-items-center">
                <i class="card p-3 fa-solid fa-person-chalkboard fs-2"></i>
            </div>
            <div>
                <p class="fs-2">Total Teacher</p>
                <h4 class="fs-5">{{ $totalTeacher }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 c3 shadow-lg d-flex gap-3 flex-wrap rounded">
            <div class="d-flex justify-content-center align-items-center">
                <i class="card p-3 fa-solid fa-building-user fs-2"></i>
            </div>
            <div>

                <p class="fs-2">Total Admin</p>
                <h4 class="fs-5">{{ $totalAdmin }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <canvas id="registrationChart" height="30%" width="75%"></canvas>
</div>
