<?php

session_start();
define("PAGE_TITLE", "Ajout Projet");

require_once("../controllers/accountController.php");


$accountController = new AccountController;
// Permet de vérifier que l'utilisateur soit connecté
$accountController->isLogged();

?>
<?php include("../assets/inc/head.php"); ?>
<?php include("../assets/inc/header.php"); ?>

<main class="container mt-5 mb-5">
    <form class="form-group" action="submit" method="post">
     
            <label for="name" >Nom du projet :</label>
            <input id="name" class="form-control" required >

            <label for="description" >Description du projet :</label>
            <input type="text" id="description" class="form-control">

            <label for="date_start" >Date de début du projet :</label>
            <input type="date" id="date_start" class="form-control" required>

            <label for="date_end" >Date de fin du projet :</label>
            <input type="date" id="date_end" class="form-control">

            <label for="link_site" >Lien du site</label>
            <input type="link" id="link_site" class="form-control">

            <label for="link_git" >Lien GitHub</label>
            <input type="link" id="link_git" class="form-control">

            <label for="cover" >Image</label>
            <input type="file" id="link_git" class="form-control">

            <div >
                <button type="submit" name= "submit" class="btn btnProject mt-4 mb-5">Ajouter</button>
            </div>


    </form>
   
    <div>
        <a href="../admin/index.php" class="btn btnProject">Retour</a>
    </div>

</main>
<?php include("../assets/inc/footer.php");

        
?>      
