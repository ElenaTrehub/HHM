<?php
include "application/models/model_task.php";
include "application/models/model_project.php";
include "application/models/model_statustask.php";
class Controller_EditTask extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        $this->PDO = $pdo;
        
        if (isset($_POST['idTask'])){
            $id = $_POST['idTask'];                    
        }
        else{
            $id = '';
        }

        $employees = array();
        $employee = new Employee_Model($this->PDO);
        $employees = $employee->GetAllEmployeeForTask(); 


        $projects = array();
        $project = new Project_Model($this->PDO);
        $projects = $project->GetProjectsForTask();

        $statuses = array();
        $status = new StatusTask_Model($this->PDO);
        $statuses = $status->GetAllTaskStatuses();



        if($id != ''){

            $task = new Task_Model($this->PDO);
            $currentTask = $task->GetTaskById($id);
            $this->view->task = $currentTask;
        }
      
        $this->view->employees = $employees;
        $this->view->statuses = $statuses;
        $this->view->projects = $projects;
        $this->view->taskId = $id;
        $this->view->upload_err = "";   
          
        
        $this->view->generate('edittask_view.php', 'template_view.php');

    }//action_index




}//Controller_EditProject