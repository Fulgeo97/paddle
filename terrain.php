<?php

session_start();
if (!isset( $_SESSION['user'])) {
    header ('location: index.php');
} 
$user = $_SESSION['user'];


require_once('connectdb.php');


$message = "";

 

if(isset($_POST)){
   
    if(isset($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['lieu'])){

            $nom = strip_tags($_POST['nom']);
            $description = strip_tags($_POST['description']);
            $lieu = strip_tags($_POST['lieu']);
             

            $sql = "INSERT INTO `terrain` (`id`, `nom`, `description`, `lieu`) VALUES (NULL, '$nom', '$description', '$lieu');";
            

            $query = $db->prepare($sql);


            $query->execute();
          

           header('Location: terrain.php');
           
            
        } 
    
       
}



if(isset($_GET)){
    if(isset($_GET['action']) && !empty($_GET['action'])
        && isset($_GET['id']) && !empty($_GET['id'])){
           
            if (($_GET['action'] == "delete")) {

                $sql = "DELETE FROM `terrain` WHERE `terrain`.`id` =".$_GET['id'].";";

                $query = $db->prepare($sql);
    
                $query->execute();
                $message = "Suppression effectuée";

            } 
           
        }
       
}



$sql_liste = "SELECT * FROM `terrain`";

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

    <title>Paddle - Dashboard</title>

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
        <?php 
        include("menu.php");
        ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Terrain</h1>

                    <div class="row">

                        <div class="col-lg-4">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enregister un terrain</h6>
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
                                        <input type="text" class="form-control form-control-user" id="description" name="description"
                                            placeholder="description">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="lieu" name="lieu"
                                            placeholder="lieu">
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
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des Terrains</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Description</th>
                                            <th>Lieu</th>
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
                                            <td><?= $liste['description'] ?></td>
                                            <td><?= $liste['lieu'] ?></td>
                                            <td><a href="?action=delete&id=<?= $liste['id'] ?>" class="btn btn-danger btn-circle">
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
    <script src="js/sb-admin-2.js"></script>

</body>

</html>