<?php 

// Commencer par l'appel du controller
require("./controllers/projectController.php");

// Instanciation de notre ccontroller
$controller = new ProjectController;


// Appel de la méthode permettant de récupérer tous les projets
$projects = $controller->readAll();

// Définition de la constante du titre de la page, que nous utilisons dans le head
define("PAGE_TITLE", "Projets");

?>
<?php include ("./assets/inc/head.php") ?>
<?php include ("./assets/inc/header.php") ?>

<main>
   
    
    
    
    
  
    <h1 class="text-center">Liste des projets</h1>

    <?php foreach ($projects as $project)
    {
        ?>
     
        <div class="card text-center" style="width: 18rem;">
        <img class="card-img-top" src="./assets/img/projects/<?=$project->cover?>" alt="">
        <div class="card-body">
          <h5 class="card-title"><?= $project->name ?></h5>
          <p class="card-text"><?= $project->description ?> </p>
          <a href=<?= $project->link_git ?> class="btn btn-primary">Lien Github</a>
          <a href=<?= $project->link_site ?> class="btn btn-primary">Lien Site</a>
        </div>
      </div>
      <?php
    }
    ?>
    
</main>

<?php include ("./assets/inc/footer.php") ?>