<?php

class ProjectModel
{
    public int $id_project;
    public string $name;
    public string $description;
    public string $date_start;
    public ?string $date_end;
    public ?string $link_site;
    public ?string $link_git;
    public ?string $cover;
    public ?array $pictures;




    // public function displayDateStart():string
    // {
    //     $dateTime =DateTime::createFromFormat("Y-m-d", $this->da)
    // }
}
