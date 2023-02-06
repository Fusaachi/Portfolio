<?php
session_start();
define("PAGE_TITLE", "Connexion");
require_once("../controllers/accountController.php");

$controller = new AccountController;

//$result = $controller->create("g.pauline91@outlook.com", "Patate78!");
//var_dump($result)

if (isset($_POST["submit"])&& isset($_POST["email"]) && (isset($_POST["password"]))) {
    // Le formulaire à été envoyé, essayons de nous connecter
    $error = $controller->login($_POST["email"], $_POST["password"]);
}


?>
<?php include("../assets/inc/head.php"); ?>
<?php include("../assets/inc/header.php"); ?>

<main>
    <div class="container  mt-5">
        <h1 class="text-center mb-5">Connexion à l'espace administrateur</h1>
        <?php if(isset($error)){?>
            <div class="alert alert-danger">
                    <?= $error["message"]?>
            </div>
        <?php } ?>

        <form  method="post">
            <div >
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div >
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div >
                <button type="submit" name= "submit" class="btn btnProject mt-4 mb-5">Connexion</button>
            </div>
        </form>
    </div>
</main>

<?php include("../assets/inc/footer.php");

        
?>      
