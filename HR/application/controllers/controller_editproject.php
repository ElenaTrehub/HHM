<?php
include "application/models/model_project.php";
include "application/models/model_task.php";
include "application/models/model_status.php";
include "application/models/model_statustask.php";
class Controller_EditProject extends Controller
{
    public function action_index()
    {
        session_start();
        
        require_once "config.php";
        $this->PDO = $pdo;
        $configStr = "";
        if(isset($_SESSION["employeesUpdateInProject"])){
            if($_SESSION["employeesUpdateInProject"] == true){
                $configStr = "Mitarbeiter erfolgreich zum Projekt hinzugefügt.";
            }
            else{
                $configStr = "Fehler beim Hinzufügen von Mitarbeitern zum Projekt.";
            }
            unset($_SESSION["employeesUpdateInProject"]);
        }
        else{
            $configStr = "";
        }

        $configTaskStr = ""; 

        if(isset($_SESSION["addTaskInProject"])){
            $configTaskStr = $_SESSION["addTaskInProject"];
            unset($_SESSION["addTaskInProject"]);
        }
        else{
            $configTaskStr = "";
        }

        if (isset($_POST['idProject'])){
            $id = $_POST['idProject'];                    
        }
        else if(isset($_POST['numberProject'])){
            $proj = new Project_Model($this->PDO);
            $id = $proj->GetProjectIdFromNumber($_POST['numberProject']);
            
        }
        else if(isset($_SESSION["currentProject"])){
            $id = $_SESSION["currentProject"];
            unset($_SESSION["currentProject"]);
        }
        else{
            $id = '';
        }

        //var_dump($id);

        $clients = array();
        $client = new Client_Model($this->PDO);
        $clients = $client->GetAllClient(); 


        $curators = array();
        $employee = new Employee_Model($this->PDO);
        $curators = $employee->GetAllProjectManager();

        $employees = array();
        $employee = new Employee_Model($this->PDO);
        $employees = $employee->GetAllEmployeeForTask();

        $statuses = array();
        $status = new Status_Model($this->PDO);
        $statuses = $status->GetAllStatuses();

        $task_statuses = array();
        $status_task = new StatusTask_Model($this->PDO);
        $task_statuses = $status_task->GetAllTaskStatuses();

        

        $projects = array();
        $proj = new Project_Model($this->PDO);
        $projects = $proj->GetAllProjects();
        
        if($id != ''){

            $tasks = array();
            $task = new Task_Model($this->PDO);
            $tasks = $task->GetAllTasksFromProject($id);
//var_dump($tasks);
            $empInProject = array();
            $proj = new Project_Model($this->PDO);
            $employeesInProject = $proj->GetEmployeesFromProject($id);

            
            $project = new Project_Model($this->PDO);
            $currentProject = $project->GetProjectById($id);
            $this->view->project = $currentProject;
            $this->view->tasks = $tasks;
            $this->view->employees = $employees;
            $this->view->employeesInProject = $employeesInProject;
           //var_dump( $this->view->employeesInProject);
           
        }

        $this->view->projects = $projects;
        $this->view->clients = $clients;
        $this->view->statuses = $statuses;
        $this->view->task_statuses = $task_statuses;
        $this->view->curators = $curators;
        $this->view->projectId = $id;
        $this->view->upload_err = $configStr;   
        $this->view->upload_task_err = $configTaskStr;
        
        $this->view->generate('editproject_view.php', 'template_view.php');

    }//action_index




}//Controller_EditProject