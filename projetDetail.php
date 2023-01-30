<?php 

// Commencer par l'appel du controller
require("./controllers/projectController.php");

// Instanciation de notre ccontroller
$controller = new ProjectController;


// Appel de la méthode permettant de récupérer les détails du projet
$project = $controller->readOne($_GET["id"]);


// Définition de la constante du titre de la page, que nous utilisons dans le head
define("PAGE_TITLE", "DETAILS");

?>
<?php include ("./assets/inc/head.php") ?>
<?php include ("./assets/inc/header.php") ?>
<main>
    <div class="text-center">
        <h1>Détails du projet <br> <?= $project->name ?> </h1>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                        
                        <div class="carousel-inner">

                            <?php foreach($project->pictures as $key=>$picture){
                            ?>

                            <div class="carousel-item <?= ($key == 0 ? 'active' : '')?> ">
                                <img src="./assets/img/projects/<?=$picture->path ?>" alt="<?=$picture->alt?>" class="imgcr d-block w-100">
                                <div class="carousel-caption d-none d-md-block">
                                    <p><?=$picture->caption ?></p>
                                </div>
                            </div>
                            
                            <?php
                            } 
                            ?>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    
                </div>
            </div>
        </div>
   
</main>

<?php include ("./assets/inc/footer.php") ?>