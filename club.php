<?php
// session_start();
// if (!isset( $_SESSION['user'])) {
//     header ('location: login.php');
// } 
// $user = $_SESSION['user'];
require_once('connectdb.php');

$message = "";

// function keygen($nbChar){
//     return substr(str_shuffle(
// 'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789_'),1, $nbChar);
//  }

 

if(isset($_POST)){
   
    if(isset($_POST['nom']) && !empty($_POST['ville'])
        && isset($_POST['adresse']) && !empty($_POST['contact'])){

            $nom = strip_tags($_POST['nom']);
            $ville = strip_tags($_POST['ville']);
            $contact = strip_tags($_POST['contact']);
            $adresse = strip_tags($_POST['adresse']);
             

            

           
           
            $sql = "INSERT INTO `club` (`id`, `nom`, `ville`, `adresse`, `contact`) VALUES (NULL, '$nom', '$ville', '$adresse','$contact');";
            

            $query = $db->prepare($sql);


            $query->execute();
          

           header('Location: club.php');
           
            
        } 
    
       
}


$sql_liste = "SELECT * FROM `club`";

// On prépare la requête
$query = $db->prepare($sql_liste);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


//require_once('connectdb.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Buttons</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa-solid fa-badminton"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Paddle</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="club.php">
            <i class="fa-solid fa-tennis-ball"></i>
            <span>Club</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="terrain.php">
            <i class="fa-solid fa-tennis-ball"></i>
            <span>Terrain</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="adherant.php">
            <i class="fa-solid fa-tennis-ball"></i>
            <span>Adhérant</span></a>
    </li>
   
    <li class="nav-item active">
        <a class="nav-link" href="reservation.php">
            <i class="fa-solid fa-tennis-ball"></i>
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

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Club</h1>

                    <div class="row">

                        <div class="col-lg-4">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enregister un club</h6>
                                </div>
                                <div class="card-body">
                                <form class="user"  method="post">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nom" name="nom"
                                            placeholder=" nom">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="ville" name="ville"
                                            placeholder="ville">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="contact" name="contact"
                                            placeholder="Contact">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <textarea id="adresse"  class="form-control form-control-user" 
                                        placeholder="Describe yourself here..." name="adresse">
                                        
                                        </textarea>
                                        
                                    </div>
                                    
                                     
                                </div>

                                
                                <button type="submit" class="btn btn-primary btn-user"  value="Submit">Enregister </button>
                                
                              
                                <hr>
                               
                                </form>
                                </div>
                            </div>

                    

                        </div>

                        <div class="col-lg-8">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des clubs</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Ville</th>
                                            <th>Adresse</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php
                                    $i = 0;
                                        foreach($result as $liste){
                                            $i++;
                                            ?>
                                            <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $liste['nom'] ?></td>
                                            <td><?= $liste['ville'] ?></td>
                                            <td><?= $liste['adresse'] ?></td>
                                            <td><?= $liste['contact'] ?></td>
                                            <td><a href="#" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>PDG</td>
                                            <td>Paris</td>
                                            <td>16 Rue Robert Collet</td>
                                            <td>6100990999</td>
                                            <td><a href="#" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>ASCOMA</td>
                                            <td>Rennes</td>
                                            <td>16 Rue Robert Collet</td>
                                            <td>610888888</td>
                                            <td><a href="#" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a></td>
                                            
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>