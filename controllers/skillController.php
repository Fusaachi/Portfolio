<?php
require_once(__DIR__ . "/../conf/conf.php");
require_once(__DIR__ . "/../models/projectModel.php");
require_once(__DIR__ . "/../models/skillModel.php");
require_once(__DIR__ . "/../models/pictureModel.php");
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

    public function readOne(int $id): SkillModel
    {
        global $pdo;
         // Requête de récupération du projet
        $sql = "SELECT * FROM skill WHERE id_skill = :id ";   //Paramètre nommé
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id",$id, PDO::PARAM_INT).
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "SkillModel");
        $result= $statement->fetch();

        // Requête de récupération des skills
        $this->loadProjectsFromSkill($result);

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

    public function updateSkill(int $id_skill, string $name, int $level, array $picture)
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

        $sql = "UPDATE skill 
                SET  name =:name, 
                level = :level, 
                picture = :picture
                WHERE id_skill = :id_skill
                ";
                

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id_skill", $id_skill);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":level", $level);
        $statement->bindParam(":picture", $image_name);

        $statement->execute();


        return [
            "success" => true,
            "message" => "La compétence a été modifiée"
        ];
    }

    public function deleteSkill(int $id_skill, string $name, int $level, array $picture)
    {

    }
}



?>