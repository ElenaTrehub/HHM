<?php


include "application/models/model_project.php";

include "application/models/model_status.php";

class Controller_UpdateProject extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $this->PDO = $pdo;

        $clients = array();
        $client = new Client_Model($this->PDO);
        $clients = $client->GetAllClient(); 


        $curators = array();
        $employee = new Employee_Model($this->PDO);
        $curators = $employee->GetAllProjectManager();

        $statuses = array();
        $status = new Status_Model($this->PDO);
        $statuses = $status->GetAllStatuses();


        if (isset($_POST['Title'])) {
            $Title = $_POST['Title'];
            $StartDate = $_POST["StartDate"];
            $EndDate = $_POST["EndDate"];
            $Destination = $_POST["Destination"];
            $Description = $_POST["Description"];
            $Number = $_POST["Number"];

            $CuratorProject = $_POST["Curator"];
            $Curator = trim($CuratorProject);
            $idCurator = 0;
            

            if($Curator!=""){
                foreach($curators as $curator){
                    $fullName = $curator->Name . " " . $curator->LastName;
                    if ($fullName == $Curator){
                        $idCurator = $curator->Id;
                        break;
                    }
                    
                }
            }

            $ClientProject = $_POST["Client"];
            $Client = trim($ClientProject);
            $idClient = "";
            

            if($Client!=""){
                foreach($clients as $client){
                    if ($Client == $client->Title){
                        $idClient = $client->idClient;
                        break;
                    }
                    
                }
            }

            $StatusProject = $_POST["Status"];
            $Status = trim($StatusProject);
            $idStatus = "";
            

            if($Status!=""){
                foreach($statuses as $status){
                    if ($Status == $status->statusProjectTitle){
                        $idStatus = $status->idStatusProject;
                        break;
                    }
                    
                }
            }
            $currentProject = new Project_Model($this->PDO);

            if($_POST["id"] == ''){
                $res = $currentProject->addProject($Title, $StartDate, $EndDate, $Destination, $Description, $idCurator, $idClient, $Number, $idStatus);
                if($res == 1){
                    header('location: /HR/projectlist');
                }
                else{
                    header('location: /HR/editproject');
                }
            }
            else{

                $res = $currentProject->updateProject($_POST["id"], $Title, $StartDate, $EndDate, $Destination, $Description, $idCurator, $idClient, $Number, $idStatus);

                if($res == 1){
                    header('location: /HR/projectlist');
                }
                else{
                    header('location: /HR/editproject');
                }


            }
        }
    }
}