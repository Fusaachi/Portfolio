<?php
require_once("./conf/conf.php");
require_once("./models/skillModel.php");
class SkillController {
    // TODO: créer les méthodes permettant des récupérer les skills (readAll()...)
    function readAll() : array 
    {
        global $pdo;
        // requête SQL
        $sql = "SELECT * FROM skill";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, "SkillModel");
        return $result;

    }
}

?>