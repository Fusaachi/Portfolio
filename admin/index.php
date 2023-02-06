<?php

session_start();
define("PAGE_TITLE", "Accueil Admin");

require_once("../controllers/accountController.php");


$accountController = new AccountController;
// Permet de vérifier que l'utilisateur soit connecté
$accountController->isLogged();

?>
<?php include("../assets/inc/head.php"); ?>
<?php include("../assets/inc/header.php"); ?>

<main class="container-fluid mt-5 mb-5">
    <h1 class="text-center" >Espace administrateur</h1>
    <p class ="text-end">Votre email : <?=$_SESSION["email"] ?></p>
    <div class="justify-content-arround text-center mb-3 ">
    <a href="../admin/ajoutCompetence.php" class="btn btnProject">Ajouter une compétence</a>
    <a href="../admin/ajoutProjet.php" class="btn btnProject">Ajouter un projet</a>

    </div>



</main>
<?php include("../assets/inc/footer.php");

        
?>      
