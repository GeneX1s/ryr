<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">


  <style>
    .wrapper {
      display: flex;
    }

    /* .sidebar {
      flex: 0 0 auto;
      /* Sidebar does not grow or shrink
    } */

    .sidebar {
    width: 200px; /* Adjust the width as needed */
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh; /* Sidebar takes full height of the viewport */
    overflow-y: auto; /* Enable scrolling for the sidebar if it's taller than the viewport */
}

    .content {
      flex: 1;
      padding-left: 220px;
      /* Content area takes up remaining space */
    }

    .container,
    .container-md,
    .container-sm {
      max-width: unset !important;
    }

    .container,
    .container-fluid,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl {
      width: 100%;
      padding-right: .75rem;
      padding-left: .75rem;
      margin-right: auto;
      margin-left: auto;

    }
  </style>

</head>


<body>
  <div class="wrapper">
    <div class="sidebar">
      @include('dashboard.layouts.sidebar')
    </div>
    <div class="content">
      <div class="container">
        @yield('container')
      </div>
    </div>
  </div>
</body>


<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; NOD 2023</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->



<!-- Bootstrap core JavaScript-->
<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<script>
// Get the sidebar element
const sidebar = document.querySelector('.sidebar');

// Function to handle scroll event
const handleScroll = () => {
    // Get the current scroll position
    const scrollY = window.scrollY || window.pageYOffset;

    // Set the top position of the sidebar based on the scroll position
    sidebar.style.top = `${scrollY}px`;
};

// Add scroll event listener to window
window.addEventListener('scroll', handleScroll);
</script>