<?php

session_start();
include "application/models/model_project.php";

class Controller_DeleteEmployeeFromProject extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $this->PDO = $pdo;

        $idProject = "";
        if (isset($_POST['idProject'])) {
            $idProject = $_POST['idProject'];
        }

        $idEmployee = "";
        if (isset($_POST['idEmployee'])) {
            $idEmployee = $_POST['idEmployee'];
        }
        
        $currentProject = new Project_Model($this->PDO);
        $res = $currentProject->DeleteEmployeeFromProject($idProject, $idEmployee);
        var_dump($res);
        if($res == 1){
            
            $_SESSION["currentProject"] = $idProject;
            header('location: /HR/editproject');
        }
        else{
            
            header('location: /HR/editproject');
        }
        
    }
}