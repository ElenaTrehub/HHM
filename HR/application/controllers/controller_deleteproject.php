<?php
include "application/models/model_project.php";
class Controller_DeleteProject extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $this->PDO = $pdo;

        $id = $_POST['idProject'];
        
        $currentProject = new Project_Model($this->PDO);
        $res = $currentProject->DeleteProject($id);
        var_dump($res);
        if($res == 1){
            header('location: /HR/projectlist');
        }
    }
}