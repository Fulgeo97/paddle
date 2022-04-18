<?php

session_start();
if (!isset( $_SESSION['user'])) {
    header ('location: index.php');
} 
$user = $_SESSION['user'];


require_once('connectdb.php');


$message = "";
$message_save = "";





 

if(isset($_POST)){
//var_dump($_POST);
    if(isset($_POST['date_reservation']) && isset($_POST['heure_debut']) 
        && isset($_POST['heure_fin'])){
           
            $date_reservation = strip_tags($_POST['date_reservation']);
            $heure_debut = strip_tags($_POST['heure_debut']);
            $heure_fin = strip_tags($_POST['heure_fin']);
            $id_terrain = strip_tags($_POST['id_terrain']);
            $id_adherant = $user['id'];
            $id_raisonspecifique =strip_tags($_POST['id_raisonspecifique']);

            $sql_resa_existe = "SELECT * FROM `reservation` where date_reservation = '$date_reservation' and ($heure_debut >= heure_debut and $heure_debut < heure_fin)  and id_terrain = $id_terrain";
            $query = $db->prepare($sql_resa_existe);
            $query->execute();
            $result_resa_existe = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($result_resa_existe)>0) {
                $message = 'il y a deja une reservation existant pour la date et heure selectionné';
            } else if ($heure_debut >= $heure_fin) {
                $message = 'l\'heure de fin doit etre superieur a l\'heure de debut';
            } else {
                $sql = "INSERT INTO `reservation` (`id`, `id_adherant`, `id_terrain`, `id_raisonspecifique`, `date_ajout`, 
                `heure_debut`, `heure_fin`, `date_reservation`) VALUES (NULL, '$id_adherant', '$id_terrain', '$id_raisonspecifique', CURRENT_TIMESTAMP, '$heure_debut', '$heure_fin', '$date_reservation');";

                $query = $db->prepare($sql);

                $query->execute();
                $message_save = 'enregistrement effectué';
            
                //header('Location: reservation.php');

            }
           
                
           
        } 
        // else {
        //     $message = 'veuillez remplir tout les champs';
        // }
    
       
}



if(isset($_GET)){
    if(isset($_GET['action']) && !empty($_GET['action'])
        && isset($_GET['id']) && !empty($_GET['id'])){
           
            if (($_GET['action'] == "delete")) {

                $sql = "DELETE FROM `reservation` WHERE `reservation`.`id` =".$_GET['id'].";";

                $query = $db->prepare($sql);
    
                $query->execute();
                $message = "Suppression effectuée";
                
            } 
           
        }
       
}



$sql_liste = "SELECT reservation.*, terrain.nom as terrain, raisonspecifique.nom as raisonspecifique, raisonspecifique.couleur as couleur, 
CONCAT(adherant.nom,' ',adherant.prenom) as adherant,adherant.email as email FROM `reservation` inner join terrain 
on terrain.id = reservation.id_terrain inner join raisonspecifique on raisonspecifique.id = reservation.id_raisonspecifique 
inner join adherant on adherant.id = reservation.id_adherant";

// On prépare la requête
$query = $db->prepare($sql_liste);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);



$sql_raisonspecifique = "SELECT * FROM `raisonspecifique`";

// On prépare la requête
$query = $db->prepare($sql_raisonspecifique);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result_raisonspecifique = $query->fetchAll(PDO::FETCH_ASSOC);



$sql_terrain = "SELECT * FROM `terrain`";

// On prépare la requête
$query = $db->prepare($sql_terrain);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result_terrain = $query->fetchAll(PDO::FETCH_ASSOC);




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
                    <h1 class="h3 mb-4 text-gray-800">Réservation</h1>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enregister une réservation</h6>
                                </div>
                                <?php if($message != "") {
                                echo '
                                <div class="alert alert-danger" role="alert">
                                '. $message .'
                                </div> ';

                                }
                                ?>
                                <?php if($message_save != "") {
                                echo '
                                <div class="alert alert-success" role="alert">
                                '. $message_save .'
                                </div> ';

                                }
                                ?>
                                <div class="card-body">
                                <form class="user"  method="post">
                                
                                 <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="id_raisonspecifique">Raison Specifique </label>
                                    <select   class="form-control form-control-user"  name="id_raisonspecifique" name="id_raisonspecifique">

                                        <?php
                                        $i = 0;
                                        foreach($result_raisonspecifique as $liste_raisonspecifique){
                                        $i++;
                                        ?>
                                        <option value="<?= $liste_raisonspecifique['id'] ?>"><?= $liste_raisonspecifique['nom'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                    </div>
                                     
                                
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="id_terrain">Terrain</label>
                                    <select   class="form-control form-control-user"  name="id_terrain" id="id_terrain">

                                        <?php
                                        $i = 0;
                                        foreach($result_terrain as $liste_terrain){
                                        $i++;
                                        ?>
                                        <option value="<?= $liste_terrain['id'] ?>"><?= $liste_terrain['nom'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                    </div>
                                     
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="date_reservation">Date de  reservation</label>
                                        <input type="date" min="<?php
                                                                   
                                                                    echo date('Y-m-d');
                                                                    ?>" class="form-control form-control-user" id="date_reservation" name="date_reservation"
                                            >
                                    </div>
                                     
                               
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="heure_debut">Heure de début</label>
                                    <select   class="form-control form-control-user" name = "heure_debut"   id = "heure_debut" >
                                    
                                    <option value="">selectionner heure de début</option>
                                                 <option value="8">8h</option>
                                                <option value="9">9h</option>
                                                 <option value="10">10h</option>
                                                <option value="11">11h</option>
                                                <option value="12">12h</option>
                                                <option value="13">13h</option>
                                                <option value="14">14h</option>
                                                <option value="15">15h</option>
                                                 <option value="16">16h</option>
                                                <option value="17">17h</option>
                                                <option value="18">18h</option>
                                                
                                            </select>
                                    </div>
                                     
                                
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label for="heure_fin">Heure de fin</label>
                                    <select   class="form-control form-control-user" name = "heure_fin"  id = "heure_fin" >
                                                 
                                    <option value="">selectionner heure de fin</option>
                                                <option value="9">9h</option>
                                                 <option value="10">10h</option>
                                                <option value="11">11h</option>
                                                <option value="12">12h</option>
                                                <option value="13">13h</option>
                                                <option value="14">14h</option>
                                                <option value="15">15h</option>
                                                 <option value="16">16h</option>
                                                <option value="17">17h</option>
                                                <option value="18">18h</option>
                                                <option value="19">19h</option>
                                            </select>
                                    </div>
                                     
                                </div>
                                

                                
                                <button type="submit" class="btn btn-primary btn-user"  value="Submit">Enregister </button>
                                
                              
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
                            <h6 class="m-0 font-weight-bold text-primary">Liste des réservations</h6>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Adherant</th>
                                    <th>Terrain</th>
                                    <th>Raison Specifique</th>
                                    <th>Date reservation</th>
                                    <th>heure début</th>
                                    <th>heure fin</th>
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
                                    <td><?= $liste['adherant'] ?></td>
                                    <td><?= $liste['terrain'] ?></td>
                                    <td><span class="badge badge-<?= $liste['couleur'] ?>"><?= $liste['raisonspecifique'] ?></span></td>
                                    <td><?= date("d/m/Y", strtotime( $liste['date_reservation'])); ?></td>
                                    <td><?= $liste['heure_debut'] ?> H</td>
                                    <td><?= $liste['heure_fin'] ?> H</td>
                                    <?php 
                                        if($user['email']==$liste['email'])
                                        {
                                    ?>
                                    <td><a href="?action=delete&id=<?= $liste['id'] ?>" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a></td>
                                    <?php 
                                        } else {
                                    ?>
                                    <td></td>
                                    <?php        
                                        }
                                    ?>
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