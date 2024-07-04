<!-- Sidebar -->
<nav class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin <sup>:)</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="/dashboard">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Website Interface
  </div>

  <!-- Nav Item - Pages Collapse Menu -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-utensils"></i>
      <span>Foods</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Foods:</h6>
        <a class="collapse-item" href="/dashboard/menus/index">Menus</a>
        <a class="collapse-item" href="/dashboard/ingredients/index">Ingredients</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/dashboard/specials/index">
      <i class="fas fa-fw fa-star"></i>
      <span>Specials</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/dashboard/events/index">
      <i class="fas fa-fw fa-calendar"></i>
      <span>Events</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/dashboard/chefs/index">
      <i class="fas fa-fw fa-person"></i>
      <span>Chefs</span></a>
  </li>


  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-image"></i>
      <span>Gallery</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Utilities:</h6>
        <a class="collapse-item" href="utilities-color.html">Colors</a>
        <a class="collapse-item" href="utilities-border.html">Borders</a>
        <a class="collapse-item" href="utilities-animation.html">Animations</a>
        <a class="collapse-item" href="utilities-other.html">Other</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Administration
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
      aria-controls="collapsePages">
      <i class="fas fa-fw fa-book"></i>
      <span>Bookings</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Login Screens:</h6>
        <a class="collapse-item" href="login.html">Login</a>
        <a class="collapse-item" href="register.html">Register</a>
        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other Pages:</h6>
        <a class="collapse-item" href="404.html">404 Page</a>
        <a class="collapse-item" href="blank.html">Blank Page</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/orders/index">
      <i class="fas fa-fw fa-list"></i>
      <span>Orders</span></a>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/inventories/index">
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Inventori</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/dashboard/employees/index">
      <i class="fas fa-fw fa-person"></i>
      <span>Karyawan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>KPI/ Statistics</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/transactions/index">
      <i class="fas fa-fw fa-table"></i>
      <span>Transactions</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

  <!-- Sidebar Message -->
  <div class="sidebar-card d-none d-lg-flex">
    {{-- <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="..."> --}}
    <p class="text-center mb-2"><strong>Pawon Bule Dashboard</strong> For all your administration needs</p>
    {{-- <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a> --}}
  </div>

</nav>
<!-- End of Sidebar -->