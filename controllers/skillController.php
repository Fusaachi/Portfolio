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

    public function createSkill()
    {

    }
}



?>