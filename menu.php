<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="reservation.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Paddle</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php 
    if($user['email']=='admin@paddle.com')
    {
    ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="club.php">
        <i class="fas fa-fw fa-chart-area"></i>
            <span>Club</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="terrain.php">
        <i class="fas fa-fw fa-table"></i>
            <span>Terrain</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="adherant.php">
        <i class="fa fa-bars"></i>
            <span>Adhérant</span></a>
    </li>
    
    <?php 
    } else {

    
    ?>

    <li class="nav-item active">
        <a class="nav-link" href="listeclub.php">
        <i class="fas fa-fw fa-chart-area"></i>
            <span>Liste Club</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="listeterrain.php">
        <i class="fas fa-fw fa-table"></i>
            <span>Liste Terrain</span></a>
    </li>
    

    <?php 
    }

    
    ?>
    
   
    <li class="nav-item active">
        <a class="nav-link" href="reservation.php">
        <i class="fas fa-bell fa-fw"></i>
            <span>Réservation</span></a>
    </li>
<!-- Divider -->
<hr class="sidebar-divider">


<li class="nav-item">
    <a class="nav-link" href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Déconexion</span></a>
</li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

  

    <!-- Nav Item - Messages -->
  

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user['nom'].  "  ". $user['prenom'] ;?></span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
       
    </li>

</ul>

</nav>