<?php
require_once(__DIR__ . "/../conf/conf.php");
require_once(__DIR__ . "/../models/projectModel.php");
require_once(__DIR__ . "/../models/pictureModel.php");
require_once(__DIR__ . "/../models/skillModel.php");

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

        foreach($result as $project) {
            $this->loadSkillsFromProject($project);
        }
        return $result;
    }

    public function readOne(int $id): ProjectModel
    {
        global $pdo;
         // Requête de récupération du projet
        $sql = "SELECT * FROM project WHERE id_project = :id ";   //Paramètre nommé
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id",$id, PDO::PARAM_INT).
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "ProjectModel");
        $result= $statement->fetch();

        // Requête de récupération des images
        $sql = "SELECT * FROM picture WHERE id_project = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id",$id, PDO::PARAM_INT).
        $statement->execute();
        $pictures = $statement->fetchAll(PDO::FETCH_CLASS, "PictureModel");

        $result->pictures = $pictures;

        // Requête de récupération des skills
        $this->loadSkillsFromProject($result);

        return $result;
    }

    public function loadSkillsFromProject(ProjectModel $project)
    {
        global $pdo;
        $sql = "SELECT 
        skill.id_skill, skill.name, skill.level, skill.picture 
        FROM skill
        INNER JOIN skill_project ON skill_project.id_skill = skill.id_skill
        INNER JOIN project ON project.id_project = skill_project.id_project
        WHERE project.id_project = :id";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":id", $project->id_project, PDO::PARAM_INT);
        $statement->execute();
        $project->skills = $statement->fetchAll(PDO::FETCH_CLASS, "SkillModel");
    }

    public function createProject(string $name, string $description, string $date_start, string $date_end, string $link_site, string $link_git, array $cover)
    {
        $image_name = time() . $cover["name"];
        move_uploaded_file($cover["tmp_name"], __DIR__ . "/../assets/img/projects/" . $image_name);
        global $pdo;

        $sql = "INSERT INTO project( name, description, date_start, date_end, link_site, link_git, cover)
                VALUES ( :name, :description, :date_start, :date_end, :link_site, :link_git, :cover)";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":date_start", $date_start);
        $statement->bindParam(":date_end", $date_end);
        $statement->bindParam(":link_site", $link_site);
        $statement->bindParam(":link_git", $link_git);
        $statement->bindParam(":cover", $image_name);

        $statement->execute();

        return [
            "success" => true,
            "message" => "Le projet a été créé"
        ];
    
    }
}


?>