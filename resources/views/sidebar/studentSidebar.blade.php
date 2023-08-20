@include('header.header')

<body id="body-pd" class="">

    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="login.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">Attender</span> </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active" onclick="stuDashboard();">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="#" class="nav_link" onclick="studentReport()">
                        <i class="fa-regular fa-file nav_icon"></i>
                        {{-- <i class='bx bx-report-content nav_icon'></i> --}}
                        <span class="nav_name">Report</span>
                    </a>
                    <a href="#" class="nav_link" onclick="studentMs()">
                        <i class='bx bx-book-content nav_icon'></i>
                        <span class="nav_name">Marksheet</span>
                    </a>

                </div>
            </div>
            <a href="{{url('/studentLogout')}}" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>

