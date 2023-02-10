<?php

session_start();
define("PAGE_TITLE", "Ajout Projet");

require_once("../controllers/accountController.php");
require_once("../controllers/skillController.php");
require_once("../controllers/projectController.php");


$accountController = new AccountController;
// Permet de vérifier que l'utilisateur soit connecté
$accountController->isLogged();
$skillController = new SkillController;

$skills = $skillController->readAll();

if(isset($_POST["submit"])){
    // Envoi des informations du formulaire pour créer un nouveau projet
    $projectController = new ProjectController;
    $projectController->createProject($_POST["name"], $_POST["description"], $_POST["date_start"], $_POST["date_end"],$_POST["link_site"],$_POST["link_git"],$_FILES["cover"],$_POST["skills"]);
}

?>
<?php include("../assets/inc/head.php"); ?>
<?php include("../assets/inc/header.php"); ?>


<main class="container mt-5 mb-5">
<h1 class="text-center mb-5"> Ajout d'un nouveau Projet</h1>
    <?php 
    if(isset($result)){
        if($result["success"]){?>
            <div class="alert alert-success"><?=$result["message"]?></div>
       <?php } else {?>
        <div class="alert alert-danger"><?=$result["message"]?></div>
     <?php  }
    }
    ?>

    <form  action="#" method="POST" enctype="multipart/form-data">
        <div class="d-inline ">
            <div class="mb-3">
                <label for="name" >Nom du projet :</label>
                <input type="text" name="name" id="name"  required >
            </div>
            <div class="mb-3">
                <label for="description" >Description du projet :</label>
                <textarea name="description" id="description" rows='5' cols='40'></textarea>
            </div>    
            <div class="mb-3">
                <label for="date_start" >Date de début du projet :</label>
                <input type="date" name="date_start" id="date_start" required>

                <label for="date_end" >Date de fin du projet :</label>
                <input type="date" name="date_end" id="date_end" >
            </div>
            <div class="mb-3">
                <label for="link_site" >Lien du site : </label>
                <input type="url" name="link_site" id="link_site" placeholder="https://example.com" >

                <label for="link_git" >Lien GitHub : </label>
                <input type="url" name="link_git" id="link_git" placeholder="https://example.com" >
            </div>
            <div class="mb-3">
                <label for="cover" >Image principale</label>
                <input type="file" name="cover" id="cover" >
            </div>
            <div class="mb-3">
                <label for="skills">Compétences</label>
                <select name="skills[]" id="skills" multiple>
                    <?php foreach($skills as $skill){?>
                        <option value="<?= $skill->id_skill ?>"><?= $skill->name ?></option>
                    <?php } ?>

                </select>
                </div>
                <div >
                    <button type="submit" name= "submit" class="btn btnProject mt-4 mb-5">Ajouter</button>
                </div>
            </div>

    </form>
   
    <div class="text-center">
        <a href="../admin/index.php" class="btn btnProject">Retour</a>
    </div>

</main>
<?php include("../assets/inc/footer.php");

        
?>      
