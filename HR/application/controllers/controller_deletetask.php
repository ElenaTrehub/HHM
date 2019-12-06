<?php
include "application/models/model_task.php";
class Controller_DeleteTask extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $this->PDO = $pdo;

        $id = $_POST['idTask'];
        //var_dump($_POST['idTask']);
        $currentTask = new Task_Model($this->PDO);
        $res = $currentTask->DeleteTask($id);
        
        if($res == 1){
            header('location: /HR/editproject');
        }
    }
}