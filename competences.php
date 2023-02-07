<?php 

// Commencer par l'appel du controller
require("./controllers/skillController.php");

// Instanciation de notre controller
$controller = new SkillController;

$skills = $controller->readAll();

// Définition de la constante du titre de la page, que nous utilisons dans le head
define("PAGE_TITLE", "Compétences");

?>
<?php include("./assets/inc/head.php"); ?>

<?php include("./assets/inc/header.php"); ?>

<main>
    <!-- TODO: afficher les compétences grâce à une boucle -->
    <div class="container mt-5 mb-5">
        <div class="row ">
        <?php foreach($skills as $skill){ ?>
            <div class="col">
                <div class="card text-center" style="width: 18rem;">
                    <img class="card-img-top" src="./assets/img/skills/<?=$skill->picture?>" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?= $skill->name ?></h5>
                        <p class="card-text ">
                            <?php for ($i=1; $i <= 5; $i++){
                                if ($i <= $skill->level)
                                {
                                    echo "<i class= 'bi bi-star-fill'></i>";
                                } else {
                                    echo '<i class="bi bi-star"></i>';
                                }
                             } ?>
                        </p>
                            <div class="row justify-content-center mb-4 ">
                            <p class="mb-1">Liste des projets créé avec : </p>
                            <?php foreach($skill->projects as $project)
                                { ?>
                                
                                <li class="list-unstyled" ><i class="bi bi-rocket-takeoff"></i><a class="detail" href="/portfolio/projet/<?=$project->id_project?>"> <?= $project->name ?></a></li>
                                
                           <?php }?>
                        </div>   
                     </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>



</main>

<?php include("./assets/inc/footer.php"); ?>