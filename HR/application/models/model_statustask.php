<?php

class StatusTask{

    public $idStatusTask;
    public $statusTaskTitle;
}

class StatusTask_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;;
    }//__construct

    public function GetAllTaskStatuses(){

        $statuses = array();

        $sql = "SELECT * FROM StatusTasks";
        if($queryStatus = $this->PDO->prepare($sql)){
            if ($queryStatus->execute()) {
                while ($rowStatus = $queryStatus->fetch()) {
                    $status = new StatusTask;
                    $status->idStatusTask = $rowStatus['idStatusTasks'];
                    $status->statusTaskTitle = $rowStatus['StatusTasksTitle'];
                    
                    $statuses[] = $status;
                }
            }

        }

        return $statuses;

    }//GetAllTaskStatuses

   
}