<?php

session_start();
include "application/models/model_project.php";

class Controller_Projectlist extends Controller{

    public function action_index(){

        require_once "config.php";
        $this->PDO = $pdo;

        $info = array();

        $currentProject = new Project_Model($this->PDO);
        $info = $currentProject->GetAllProjects();

        $this->view->projectList = $info;
        $this->view->generate('projectlist_view.php', 'template_view.php');
    }
    
}