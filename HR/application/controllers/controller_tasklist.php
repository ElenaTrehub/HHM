<?php

session_start();
include "application/models/model_task.php";
include "application/models/model_calendarproject.php";


class Controller_Tasklist extends Controller{

    public function action_index(){

        require_once "config.php";
        $this->PDO = $pdo;

        if (isset($_POST['idProject'])) {

            $idProject = $_POST['idProject'];

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
            
            $this->view->project = $project;
            $this->view->calendar = $currentCalendar;
            $this->view->taskList = $tasks;
            $this->view->generate('tasklist_view.php', 'template_view.php');
        }//if

        
    }//action_index
    
}