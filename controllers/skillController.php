<?php
require_once(__DIR__ . "/../conf/conf.php");
require_once(__DIR__ . "/../models/skillModel.php");
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
        foreach($result as $skill) {
            $this->loadProjectsFromSkill($skill);
        }
        return $result;
    }

  
    public function loadProjectsFromSkill(SkillModel $skill)
    {
        global $pdo;
        $sql = "SELECT project.name, project.id_project
        FROM project
        
        INNER JOIN skill_project ON skill_project.id_project = project.id_project
        INNER JOIN skill ON skill.id_skill = skill_project.id_skill
        WHERE skill.id_skill = :id";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $skill->id_skill, PDO::PARAM_INT);
        $statement->execute();
        $skill->projects = $statement->fetchAll(PDO::FETCH_CLASS, "SkillModel");
    }

    public function createSkill(string $name, int $level, array $picture) 
    {
        if(strlen($name)> 255)
        {
            return [
                "success" => false,
                "message" => "Le nom doit contenir 255 caractère"
            ];
        }
        if($level < 1 || $level > 5)
        {
            return [
                "success" => false,
                "message" => "Le niveau doit être compris entre 1 et 5"
            ];
        }

        if(!in_array($picture["type"],["image/png", "image/jpeg", "image/webp"]))
        {
            return [
                "success" => false,
                "message" => "Formats d'image acceptés :  Png, Jpeg, Webp"
            ];
        }

        // Les informations sont correctes : stockons l'image en lui attribuant un nouveau nom unique
        $image_name = time() . $picture["name"];
        move_uploaded_file($picture["tmp_name"], __DIR__ . "/../assets/img/skills/" . $image_name);
            
         // L'image a bien été stockée, exécutons la requête pour ajouter la compétence
        global $pdo;

        $sql = "INSERT INTO skill ( name, level, picture)
                VALUES ( :name, :level, :picture)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":level", $level);
        $statement->bindParam(":picture", $image_name);

        $statement->execute();


        return [
            "success" => true,
            "message" => "La compétence a été crée"
        ];
    }
}



?>