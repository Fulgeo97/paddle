<?php
require_once 'connectdb.php';

$message = '';

if (isset($_POST)) {
    
    if (
        isset($_POST['id_club']) && isset($_POST['nom']) && isset($_POST['prenom'])
        && isset($_POST['date_nais']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['telephone']))
        {
            $id_club = strip_tags($_POST['id_club']);
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $date_nais = strip_tags($_POST['date_nais']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags(md5($_POST['password'])); 
            $password_confirme = strip_tags(md5($_POST['password_confirme']));
            $telephone = strip_tags($_POST['telephone']);
       

        if ($password == $password_confirme) {
             
        $sql = "INSERT INTO `adherant` (`id`, `id_club`, `nom`, `prenom`, `date_nais`, `email`, `password`, `telephone`) 
        VALUES (NULL, '$id_club', '$nom', '$prenom ', '$date_nais', '$email', '$password', ' $telephone');";
        

        $query = $db->prepare($sql);


        $query->execute();
      

        header('Location: index.php');
            
          
       }  else {
            $message = 'Le mot de passe confirmé est different ';
    
    }
}


$sql_liste = "SELECT adherant.*,club.nom  as nom_club  FROM adherant INNER JOIN club ON adherant.id_club=club.id";

// On prépare la requête
$query = $db->prepare($sql_liste);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
}


$sql_club = "SELECT * FROM `club`";
//var_dump($sql_club);
// On prépare la requête
$query = $db->prepare($sql_club);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result_club = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Register</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet">

    </head>

        <body class="bg-gradient-primary">

            <div class="container">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Créer un compte!</h1>
                                    </div>
                                    <?php if ($message != '') {
                                        echo '
                                        <div class="alert alert-danger" role="alert">
                                        ' .
                                            $message .
                                            '
                                    </div>
                                    ';
                                    } ?>
                                    <form class="user" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="exampleFirstName" name="nom"
                                                    placeholder=" Nom">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" id="exampleLastName" name="prenom"
                                                    placeholder="Prénom">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" class="form-control form-control-user"
                                                    id="exampleDate" name="date_nais" placeholder="Date de naissance">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user"
                                                    id="exampleTelephone" name="telephone" placeholder="Numéro de téléphone">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input type="texte" class="form-control form-control-user" id="exampleInputEmail" name="email"
                                                    placeholder=" Adresse Email ">
                                            </div>
                                            
                                            <div class="col-sm-6">
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
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" name="password" placeholder="Mot de passe">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="exampleRepeatPassword" name="password_confirme" placeholder="Confirmer le mot de passe ">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"  value="Submit">S'inscrire </button>
                                        <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                            S'inscrire
                                        </a> -->
                                        <hr>
                                    
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Déjà inscrit? Connectez vous!</a>
                                    </div>
                                </div>
                            </div>
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