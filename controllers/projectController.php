<?php
require_once("./conf/conf.php");
require_once("./models/projectModel.php");
class ProjectController
{
    public function readAll() : array
    {
        global $pdo;
        // requête SQL
        $sql = "SELECT * FROM project ";
        $statement = $pdo->prepare($sql);
        // Executer
        $statement->execute();
        // Mettre sous forme de tableau
        $result = $statement->fetchAll(PDO::FETCH_CLASS, "ProjectModel");
        return $result;
    }
}

?>