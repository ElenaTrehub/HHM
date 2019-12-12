<?php

include "application/models/model_task.php";


class Controller_EditTasksDate extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        $this->PDO = $pdo;

        $projectId = "";
        if (isset($_POST['projectId'])) {
            $projectId = $_POST['projectId'];
        }

        if (isset($_POST['tasksList'])) {
            //var_dump($_POST['tasksList']);

            $response = json_decode($_POST['tasksList'], true); // преобразование строки в формате json в ассоциативный массив 
            //var_dump($response);
            $currentTask = new Task_Model($this->PDO);

            foreach($response as $item){
                var_dump($item['taskId']);
                var_dump($item['startDate']);
                var_dump($item['endDate']);
                //echo("--------------------");
                $result = $currentTask->UpdateTaskDate($item['taskId'], $item['startDate'], $item['endDate']);  
                if($result == 1){
                    continue;
                }
                else{
                    break;
                    $_SESSION["updateDateTask"] = -1;
                    $_SESSION["currentProject"] = $projectId;
                    header('location: /HR/tasklist');
                }
            }

            $_SESSION["updateDateTask"] = 1;
            $_SESSION["currentProject"] = $projectId;
            header('location: /HR/tasklist');

            
        } 
    }
}