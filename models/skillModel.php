<?php

class SkillModel{
    // TODO: Ajouter ici les propriétés de la table "skill" dans la base de données

    public int $id_skill;
    public string $name;
    public int $level;
    public ?string $picture;
    public ?array $projects;
}

?>