@include('header.header')

<body id="body-pd" class="">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        {{-- <div class="header_img"> <img src="login.jpg" alt=""> </div> --}}

        <div class="dropdown">
            <ion-icon class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false" name="notifications"
                class="text-danger fs-4"></ion-icon>
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ count($notifications) }}</span>
            </button>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                @foreach ($notifications as $notifiaction)
                    <li class="dl d-flex m-1 d-flex justify-content-center align-items-center">
                        <p class="dropdown-item" style="font-size: 9px">{{ $notifiaction->data['name'] }}</p>
                        <p class="dropdown-item" style="font-size: 9px">{{ $notifiaction->data['gender'] }}</p>
                        <p class="dropdown-item" style="font-size: 9px">{{ $notifiaction->data['role'] }}</p>
                        <a href="/readNotification/{{ $notifiaction->id }}"><button class='btn btn-outline-danger mx-1'
                                style="font-size: 7px">Read</button></a>
                    </li>
                @endforeach
                {{-- <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                @if (count($notifications) > 0)
                    <a href="/markAllAsRead" class="d-flex justify-content-center"><button
                            class="btn btn-outline-danger btn-sm">MarkAllAsRead</button></a>
                @endif
            </ul>
        </div>

    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">Attender</span> </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active" onclick="dashboard();">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addAdmin()">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Profile</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addStudent()">
                        <i class='bx bx-user-plus nav_icon'></i>
                        @if (isset($notificationGroupWiseCount['App\Notifications\WelcomwNotification']['total']))
                            <span
                                class="position-absolute top-0 start-10  badge rounded-pill bg-danger">{{ $notificationGroupWiseCount['App\Notifications\WelcomwNotification']['total'] }}</span>
                        @endif
                        <span class="nav_name">Add Student</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addTeacher()">
                        {{-- <i class='bx bx-user-detail nav_icon'></i> --}}
                        <i class='bx bxs-user-detail nav_icon'></i>
                        @if (isset($notificationGroupWiseCount['App\Notifications\AddTeacherNotifications']['total']))
                            <span
                                class="position-absolute top-0 start-10  badge rounded-pill bg-danger">{{ $notificationGroupWiseCount['App\Notifications\AddTeacherNotifications']['total'] }}</span>
                        @endif
                        <span class="nav_name">Add Teacher</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addClass()">
                        <i class='bx bx-user-pin nav_icon'></i>
                        <span class="nav_name">Add Classroom</span>
                    </a>
                    <a href="#" class="nav_link" onclick="viewClass()">
                        <i class='bx bx-building-house nav_icon'></i>
                        <span class="nav_name">View Classroom</span>
                    </a>
                </div>
            </div> <a href="{{ url('/adminLogout') }}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
        </nav>
    </div>

    {{-- @include('footer.footer') --}}
