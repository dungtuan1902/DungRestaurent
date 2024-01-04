<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DT Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main manager
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDepartment"
            aria-expanded="true" aria-controls="collapseDepartment">
            <i class="fa-solid fa-people-roof"></i>

            <span>Department Manager</span>
        </a>
        <div id="collapseDepartment" class="collapse" aria-labelledby="headingDepartment"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header"></h6> --}}
                <a class="collapse-item" href="">Department Manager</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-users"></i>

            <span>Staff Manager</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header"></h6> --}}
                <a class="collapse-item" href="">Cashier</a>
                <a class="collapse-item" href="">Chef</a>
                <a class="collapse-item" href="">Guard</a>
                <a class="collapse-item" href="">Manager</a>
                <a class="collapse-item" href="">Serving staff</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRole"
            aria-expanded="true" aria-controls="collapseRole">
            <i class="fa-solid fa-users-between-lines"></i>

            <span>Role Manager</span>
        </a>
        <div id="collapseRole" class="collapse" aria-labelledby="headingRole" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header"></h6> --}}
                <a class="collapse-item" href="">Role Manager</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-home"></i>
            <span>Room Manager</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Room Type Manager</a>
                <a class="collapse-item" href="">Room Manager</a>
                <a class="collapse-item" href="">Ulitity Room Manager</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseService"
            aria-expanded="true" aria-controls="collapseService">
            <i class="fa-brands fa-servicestack"></i>
            <span>Service Manager</span>
        </a>
        <div id="collapseService" class="collapse" aria-labelledby="headingService" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Service Manager</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="true" aria-controls="collapseUser">
            <i class="fa-solid fa-user"></i>
            <span>User Manager</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">User Manager</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePolicy"
            aria-expanded="true" aria-controls="collapsePolicy">
            <i class="fa-solid fa-bookmark"></i>
            <span>Policy Manager</span>
        </a>
        <div id="collapsePolicy" class="collapse" aria-labelledby="headingPolicy" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Cancellation Manager</a>
                <a class="collapse-item" href="">Penalty Manager</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Booking
    </div>
    {{-- Booking --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooking"
            aria-expanded="true" aria-controls="collapseBooking">
            <i class="fa-brands fa-first-order"></i>
            <span>Booking Manager</span>
        </a>
        <div id="collapseBooking" class="collapse" aria-labelledby="headingBooking" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Booking Manager</a>
                <a class="collapse-item" href="">Billing Manager</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Food and Drinking
    </div>
    {{-- Booking --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFood"
            aria-expanded="true" aria-controls="collapseFood">
            <i class="fa-solid fa-utensils"></i>
            <span>Food Manager</span>
        </a>
        <div id="collapseFood" class="collapse" aria-labelledby="headingFood" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Food Type Manager</a>
                <a class="collapse-item" href="">Food Manager</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDrinking"
            aria-expanded="true" aria-controls="collapseDrinking">
            <i class="fa-solid fa-martini-glass-empty"></i>
            <span>Drinking Manager</span>
        </a>
        <div id="collapseDrinking" class="collapse" aria-labelledby="headingDrinking"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Drinking Type Manager</a>
                <a class="collapse-item" href="">Drinking Manager</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Statistical</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fa-solid fa-gear"></i>
            <span>Setting</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    {{-- <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!
        </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
<!-- End of Sidebar -->
