<?php

class Status{

    public $idStatusProject;
    public $statusProjectTitle;
}

class Status_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;;
    }//__construct

    public function GetAllStatuses(){

        $statuses = array();

        $sql = "SELECT * FROM StatusProject";
        if($queryStatus = $this->PDO->prepare($sql)){
            if ($queryStatus->execute()) {
                while ($rowStatus = $queryStatus->fetch()) {
                    $status = new Status;
                    $status->idStatusProject = $rowStatus['idStatusProject'];
                    $status->statusProjectTitle = $rowStatus['StatusProjectTitle'];
                    
                    $statuses[] = $status;
                }
            }

        }

        return $statuses;

    }//GetAllStatuses

   
}