<?php

session_start();
include "application/models/model_project.php";
include "application/models/model_calendarproject.php";


class Controller_Projectlist extends Controller{

    public function action_index(){

        require_once "config.php";
        $this->PDO = $pdo;

        $info = array();

        $currentProject = new Project_Model($this->PDO);
        $info = $currentProject->GetAllProjects();


        
        $minStartDate = strtotime($info[0]->project->Start);  
        $maxEndtDate = strtotime($info[0]->project->End);


        foreach($info as $proj){

            $projStart = strtotime($proj->project->Start);
            if ($projStart < $minStartDate){

                $minStartDate = $projStart;
            }
            $projEnd = strtotime($proj->project->End);

            if ($projEnd > $maxEndtDate){

                $maxEndtDate = $projEnd;
            }
        }

/* var_dump(gmdate("Y-m-d", $minStartDate));
var_dump(gmdate("Y-m-d", $maxEndtDate)); */
        $calendar = new CalendarProject_Model();
        $currentCalendar = $calendar->CreateCalendar($minStartDate, $maxEndtDate);

        $this->view->calendar = $currentCalendar;
        $this->view->projectList = $info;
        $this->view->generate('projectlist_view.php', 'template_view.php');
    }
    
}