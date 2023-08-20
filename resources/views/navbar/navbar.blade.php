@include('header.header')
<nav class="navbar navbar-expand-lg navbar-dark position-sticky top-0" style="background: #1f2940">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Attender</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/submitExcel') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/studentview') }}">View Student</a>
                </li>
            </ul>

        </div>
            <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
    </div>
</nav>
@include('footer.footer')