<?php
include "application/models/model_project.php";
include "application/models/model_task.php";
include "application/models/model_status.php";

class Controller_EditProject extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        $this->PDO = $pdo;
        
        if (isset($_POST['idProject'])){
            $id = $_POST['idProject'];                    
        }
        else if(isset($_POST['numberProject'])){
            $proj = new Project_Model($this->PDO);
            $id = $proj->GetProjectIdFromNumber($_POST['numberProject']);
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

        $tasks = array();
        $task = new Task_Model($this->PDO);
        $tasks = $task->GetAllTasksFromProject($id);

        $projects = array();
        $proj = new Project_Model($this->PDO);
        $projects = $proj->GetAllProjects();
        //var_dump($projects);
        if($id != ''){

            $project = new Project_Model($this->PDO);
            $currentProject = $project->GetProjectById($id);
            $this->view->project = $currentProject;
            $this->view->tasks = $tasks;
            $this->view->employees = $employees;
        }

        $this->view->projects = $projects;
        $this->view->clients = $clients;
        $this->view->statuses = $statuses;
        $this->view->curators = $curators;
        $this->view->projectId = $id;
        $this->view->upload_err = "";   
        $this->view->passport_upload_err = "";           
        
        $this->view->generate('editproject_view.php', 'template_view.php');

    }//action_index




}//Controller_EditProject