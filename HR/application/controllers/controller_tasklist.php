<?php

session_start();
include "application/models/model_task.php";
include "application/models/Employee.php";
include "application/models/model_calendarproject.php";


class Controller_Tasklist extends Controller{

    public function action_index(){

        require_once "config.php";
        $this->PDO = $pdo;

        $configStr = "";
        if(isset($_SESSION["updateDateTask"])){
            if($_SESSION["updateDateTask"] == 1){
                $configStr = "Termine wurden erfolgreich aktualisiert.";
            }
            else{
                $configStr = "Datum konnte nicht aktualisiert werden.";
            }
            unset($_SESSION["updateDateTask"]);
        }
        else{
            $configStr = "";
        }


        if (isset($_POST['idProject'])){
            $idProject = $_POST['idProject'];                    
        }
        
        else if(isset($_SESSION["currentProject"])){
            $idProject = $_SESSION["currentProject"];
            unset($_SESSION["currentProject"]);
        }
        else{
            $idProject = '';
        }

        if ($idProject!="") {

            

            $employees = array();
            $currentEmployee = new Employee_Model($this->PDO);
            $employees = $currentEmployee->GetEmployeesFromRroject($idProject);
            


            $tasks = array();

            $currentTask = new Task_Model($this->PDO);
            $tasks = $currentTask->GetAllTasksFromProject($idProject);


        
            $minStartDate = strtotime($tasks[0]->TaskStart);  
            $maxEndtDate = strtotime($tasks[0]->TaskEnd);

            $project = $tasks[0]->Project;
            foreach($tasks as $task){

                $taskStart = strtotime($task->TaskStart);
                if ($taskStart < $minStartDate){

                    $minStartDate = $taskStart;
                }//if
                $taskEnd = strtotime($task->TaskEnd);

                if ($taskEnd > $maxEndtDate){

                    $maxEndtDate = $taskEnd;
                }//if
            }//foreach

            $calendar = new CalendarProject_Model();
            $currentCalendar = $calendar->CreateCalendar($minStartDate, $maxEndtDate);

            $this->view->empList = $employees;
            $this->view->projectId = $idProject;
            $this->view->project = $project;
            $this->view->calendar = $currentCalendar;
            $this->view->taskList = $tasks;
            $this->view->upload_err = $configStr;
            $this->view->generate('tasklist_view.php', 'template_view.php');
        }//if

        
    }//action_index
    
}