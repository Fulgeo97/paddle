<?php

session_start();
if (!isset( $_SESSION['user'])) {
    header ('location: index.php');
} 
$user = $_SESSION['user'];


require_once('connectdb.php');


$message = "";

// function keygen($nbChar){
//     return substr(str_shuffle(
// 'abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789_'),1, $nbChar);
//  }

 

if(isset($_POST)){
   
   
    if( isset($_POST['id_club']) && isset($_POST['nom']) && isset($_POST['prenom'])
        && isset($_POST['date_nais']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['telephone'])){
            $id_club = strip_tags($_POST['id_club']);
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $date_nais = strip_tags($_POST['date_nais']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $telephone = strip_tags($_POST['telephone']);

           
           
            $sql = "INSERT INTO `adherant` (`id`, `id_club`, `nom`, `prenom`, `date_nais`, `email`, `password`, `telephone`) 
            VALUES (NULL, '$id_club', '$nom', '$prenom ', '$date_nais', '$email', ' $password ', ' $telephone');";
            

            $query = $db->prepare($sql);


            $query->execute();
          

           header('Location: adherant.php');
           
            
        } 
    
       
}


if(isset($_GET)){
    if(isset($_GET['action']) && !empty($_GET['action'])
        && isset($_GET['id']) && !empty($_GET['id'])){
           
            if (($_GET['action'] == "delete")) {

                $sql = "DELETE FROM `adherant` WHERE `adherant`.`id` =".$_GET['id'].";";

                $query = $db->prepare($sql);
    
                $query->execute();
                $message = "Suppression effectuée";

            } 
           
        }
       
}





$sql_liste = "SELECT adherant.*,club.nom  as nom_club  FROM adherant INNER JOIN club ON adherant.id_club=club.id";

// On prépare la requête
$query = $db->prepare($sql_liste);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


$sql_club = "SELECT * FROM `club`";

// On prépare la requête
$query = $db->prepare($sql_club);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result_club = $query->fetchAll(PDO::FETCH_ASSOC);


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
<?php 
   include("menu.php");
?>
        <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Adhérant</h1>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enregister un adhérant</h6>
                                </div>
                                <div class="card-body">
                                <form class="user"  method="post">

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                    <select   class="form-control form-control-user"  name="id_club">

                                    <?php
                                    $i = 0;
                                        foreach($result_club as $liste_club){
                                            $i++;
                                            ?>
                                            <option value="<?= $liste_club['id'] ?>"><?= $liste_club['nom'] ?></option>
                                            
                                            <?php
                                        }
                                    ?>
                                            </select>
                                    </div>
                                     
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nom" name="nom"
                                            placeholder=" nom">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="prenom" name="prenom"
                                            placeholder="prenom">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user" id="date_nais" name="date_nais"
                                            placeholder="date de naissance">
                                    </div>
                                     
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="email" name="email"
                                            placeholder="email">
                                    </div>
                                     
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="password" name="password"
                                            placeholder="password">
                                    </div>
                                     
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="telephone" name="telephone"
                                            placeholder="telephone">
                                    </div>
                                     
                                </div>

                                <button type="submit" class="btn btn-primary btn-user"  value="Submit">Enregistrer </button>
                                
                              
                                <hr>
                               
                            </form>
                                </div>
                            </div>

                    

                        </div>

                        

                    </div>
                    <div class="row">

                        

                        <div class="col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des adhérants</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Club</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Date de naissance</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
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
                                            <td><?= $liste['nom_club'] ?></td>
                                            <td><?= $liste['nom'] ?></td>
                                            <td><?= $liste['prenom'] ?></td>
                                            <td><?= $liste['date_nais'] ?></td>
                                            <td><?= $liste['email'] ?></td>
                                            <td><?= $liste['telephone'] ?></td>
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