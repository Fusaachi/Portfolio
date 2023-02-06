<?php

session_start();
define("PAGE_TITLE", "Ajout Competence");

require_once("../controllers/accountController.php");


$accountController = new AccountController;
// Permet de vérifier que l'utilisateur soit connecté
$accountController->isLogged();

?>
<?php include("../assets/inc/head.php"); ?>
<?php include("../assets/inc/header.php"); ?>

<main class="container-fluid mt-5 mb-5">
    <form action="submit" method="post">
            <h1 class="text-center"> Ajout d'une nouvelle compétence</h1>

            <label for="name" >Nom :</label>
            <input id="name">

            <label for="level" >Niveau :</label>
            <input type="text" id="level">
        </div>
        <div>
            <label for="picture" >Image :</label>
            <input type="file" id="picture">
        </div>
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
