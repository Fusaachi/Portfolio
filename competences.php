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
        <div class="row">
        <?php foreach($skills as $skill){ ?>
            <div class="col">
                <div class="card text-center" style="width: 18rem;">
                    <img class="card-img-top" src="./assets/img/skills/<?=$skill->picture?>" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?= $skill->name ?></h5>
                        <p class="card-text cardProject ">
                            <?= $skill->level ?> </p>
                     </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>



</main>

<?php include("./assets/inc/footer.php"); ?>