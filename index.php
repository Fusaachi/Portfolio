<?php 

// Commencer par l'appel du controller
// require(controller/...)

// Définition de la constante du titre de la page, que nous utilisons dans le head
define("PAGE_TITLE", "Accueil");

?>
<?php include ("./assets/inc/head.php") ?>
<?php include ("./assets/inc/header.php") ?>
<main>
    <div>
        <nav id="navbar" class="navbar nav-menu">
            <ul>
                <li><a href="#me" class="nav-link scrollto active"> <i class="bi bi-house-door"></i> <span>Home</span></a></li>
                <li><a href="#about" class="nav-link scrollto"><i class="bi bi-person"></i> <span>About</span></a></li>
                <li><a href="#resume" class="nav-link scrollto"><i class="bi bi-file-earmark"></i> <span>Resume</span></a></li>
            </ul>
        </nav>
        <section  id="me" class="d-flex flex-column justify-content-center">
            <h1 id="name"> Giroux Pauline </h1>
        </section>
        <section id="about" class="">
            <h2 class="subtitle">À Propos</h2>
            <p> </p>
            <div class="row">
                <div class="col-3">
                    <img id="picture1"src="./assets/img/index/moi2.JPG">
                </div>
                <div class="col-3">
                    <h3>Developpeuse Web PHP.</h3>
                </div>
            </div>

        </section>
    </div>
</main>

<?php include ("./assets/inc/footer.php") ?>