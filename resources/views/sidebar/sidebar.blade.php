
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
                    <a href="#" class="nav_link active" onclick="dashboard();">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addAdmin()">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Add Admin</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addStudent()">
                        <i class='bx bx-user-plus nav_icon'></i>
                        <span class="nav_name">Add Student</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addTeacher()">
                        <i class='bx bx-user-pin nav_icon'></i>
                        <span class="nav_name">Add Teacher</span>
                    </a>
                    <a href="#" class="nav_link" onclick="addClass()">
                        <i class='bx bx-user-pin nav_icon'></i>
                        <span class="nav_name">Add Classroom</span>
                    </a>
                </div>
            </div> <a href="{{url('/adminLogout')}}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
        </nav>
    </div>

{{-- @include('footer.footer') --}}
