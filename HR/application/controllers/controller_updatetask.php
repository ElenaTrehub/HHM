<?php

include "application/models/model_task.php";
include "application/models/model_project.php";
include "application/models/model_statustask.php";

class Controller_UpdateTask extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $this->PDO = $pdo;

        $employees = array();
        $employee = new Employee_Model($this->PDO);
        $employees = $employee->GetAllEmployeeForTask(); 


        $projects = array();
        $project = new Project_Model($this->PDO);
        $projects = $project->GetProjectsForTask();

        $statuses = array();
        $status = new StatusTask_Model($this->PDO);
        $statuses = $status->GetAllTaskStatuses();


        if (isset($_POST['Title'])) {
            $Title = $_POST['Title'];
            $Text = $_POST['Text'];
            $StartDate = $_POST["StartDate"];
            $EndDate = $_POST["EndDate"];
            

            $EmployeeTask = $_POST["Employee"];
            $Employee = trim($EmployeeTask);
            $idEmployee = 0;
            

            if($Employee!=""){
                foreach($employees as $employee){
                    $fullName = $employee->Name . " " . $employee->LastName . " - ". $employee->Position;
                    if ($fullName == $Employee){
                        $idEmployee = $employee->Id;
                        break;
                    }
                    
                }
            }

            $CuratorTask = $_POST["Curator"];
            $Curator = trim($CuratorTask);
            $idCurator = "";
            

            if($Curator!=""){
                foreach($employees as $employee){
                    $fullName = $employee->Name . " " . $employee->LastName . " - ". $employee->Position;
                    if ($fullName == $Curator){
                        $idCurator = $employee->Id;
                        break;
                    }
                    
                }
            }

            $Project = $_POST["Project"];
            $Project = trim($Project);
            $idProject = "";
            

            if($Project!=""){
                foreach($projects as $project){
                    if ($Project == $project->Number){
                        $idProject = $project->IdProject;
                        break;
                    }
                    
                }
            }

            $Status = $_POST["Status"];
            $Status = trim($Status);
            $idStatus = "";
            

            if($Status!=""){
                foreach($statuses as $status){
                    if ($Status == $status->statusTaskTitle){
                        $idStatus = $status->idStatusTask;
                        break;
                    }
                    
                }
            }
            $currentTask = new Task_Model($this->PDO);

            if($_POST["id"] == ''){
                $res = $currentTask->addTask($Title, $Text, $StartDate, $EndDate, $idEmployee, $idCurator, $idProject, $idStatus);
                if($res == 1){
                    header('location: /HR/projectlist');
                }
                else{
                    header('location: /HR/editproject');
                }
            }
            else{

                $res = $currentTask->updateTask($_POST["id"], $Title, $Text, $StartDate, $EndDate, $idEmployee, $idCurator, $idProject, $idStatus);

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