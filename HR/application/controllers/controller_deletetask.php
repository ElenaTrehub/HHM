<?php
include "application/models/model_task.php";
class Controller_DeleteTask extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $this->PDO = $pdo;

        $id = $_POST['idTask'];
        
        $currentTask = new Task_Model($this->PDO);
        $res = $currentTask->DeleteTask($id);
        var_dump($res);
        if($res == 1){
            header('location: /HR/projectlist');
        }
    }
}