<?php
session_start();
include "application/models/model_task.php";
include "application/models/Employee.php";
include "application/models/model_calendarproject.php";
class Controller_EmployeeTasks extends Controller{


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


        if (isset($_POST['idEmployee'])){
            $idEmployee = $_POST['idEmployee'];                    
        }
        
        else if(isset($_SESSION["currentEmployee"])){
            $idEmployee = $_SESSION["currentEmployee"];
            unset($_SESSION["currentEmployee"]);
        }
        else{
            $idEmployee = '';
        }

        

        if($idEmployee != ""){

            $currentEmployee = new Employee_Model($this->PDO);
            $employee = $currentEmployee->GetEmployeeById($idEmployee);
            


            $tasks = array();

            $currentTask = new Task_Model($this->PDO);
            $tasks = $currentTask->GetAllTasksFromEmployee($idEmployee);


        
            $minStartDate = strtotime($tasks[0]->TaskStart);  
            $maxEndtDate = strtotime($tasks[0]->TaskEnd);

            $employee = $tasks[0]->Employee;

            $projects = array();
            foreach($tasks as $task){

                $obj = new stdClass();
                $obj->id = $task->idProject;
                $obj->project = $task->Project;
                if (in_array($obj, $projects) == false) {
                    $projects[] = $obj;
                }
                

                $taskStart = strtotime($task->TaskStart);
                if ($taskStart < $minStartDate){

                    $minStartDate = $taskStart;
                }//if
                $taskEnd = strtotime($task->TaskEnd);

                if ($taskEnd > $maxEndtDate){

                    $maxEndtDate = $taskEnd;
                }//if
            }//foreach
            //var_dump($projects);

            $calendar = new CalendarProject_Model();
            $currentCalendar = $calendar->CreateCalendar($minStartDate, $maxEndtDate);

            $this->view->projectList = $projects;
            $this->view->employee = $employee;
            $this->view->idEmployee = $idEmployee;
            $this->view->calendar = $currentCalendar;
            $this->view->taskList = $tasks;
            $this->view->upload_err = $configStr;
            $this->view->generate('employeetasks_view.php', 'template_view.php');


        }

    }//index



}//Controller_EmployeeTasks 