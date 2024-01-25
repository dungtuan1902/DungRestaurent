<section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
        <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
        <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Mon-Sat: 11:00 AM - 23:00 PM</span></i>
    </div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <div class="logo me-auto">
            <h1><a href="{{ route('client.main') }}">DungTuanRestaurent</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="{{ route('client.main') }}#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#about">About</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#menu">Menu</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#specials">Specials</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#events">Events</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#chefs">Chefs</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#gallery">Gallery</a></li>
                <li><a class="nav-link scrollto" href="{{ route('client.main') }}#contact">Contact</a></li>
                @if (Auth::guard('web')->user())
                    <li class="nav-item dropdown">
                        <a class="nav-link scrollto dropdown-toggle" href="{{ route('client.profile') }}"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('client.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Billing</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('client.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link scrollto" href="{{ route('client.login') }}">Login</a></li>
                @endif



            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="#book-a-table" class="book-a-table-btn scrollto">Book a table</a>

    </div>
</header><!-- End Header -->
