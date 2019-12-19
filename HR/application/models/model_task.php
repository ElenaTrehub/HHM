<?php

class Task{

    public $idTask;
    public $TaskTitle;
    public $TaskText;
    public $TaskStart;
    public $TaskEnd;
    public $idEmployee;
    public $Employee;
    public $Curator;
    public $idProject;
    public $Project;
    public $StatusTask;
    public $Is_Past;
    public $Is_Finish;
}

class Task_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;;
    }//__construct

    public function GetTaskById($id){

        $sql = $sql = "SELECT * FROM Task 
        LEFT JOIN Employee        ON Task.idEmployee = Employee.id
        LEFT JOIN Project         ON Task.idProject = Project.idProject
        LEFT JOIN StatusTasks     ON Task.idStatusTasks = StatusTasks.idStatusTasks
        LEFT JOIN Career ON Task.idEmployee = Career.idEmployee
        WHERE Task.idTask = :id";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            if ($query->execute()) {
                
                while ($row = $query->fetch()) {
            
                    $task = new Task;
                    $task->idTask = $row['idTask'];
                    $task->TaskTitle = $row['TaskTitle'];
                    $task->TaskText = $row['TaskText'];
                    $task->TaskStart = $row['TaskStart'];
                    $task->TaskEnd = $row['TaskEnd'];
                    $task->Employee = $row['Name'] . " " . $row['LastName'] . " - ". $row['Position'];
                    $task->Curator = $row['idCurator'];
                    $task->Project = $row['ProjectNumber'];
                    $task->StatusTask = $row['StatusTasksTitle'];
                }
                    
            }
        }
        $sql = $sql = "SELECT * FROM Employee 
        LEFT JOIN Career ON Employee.id = Career.idEmployee
        WHERE Employee.id = :id";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":id", $task->Curator, PDO::PARAM_STR);
            if ($query->execute()) {
                
                while ($row = $query->fetch()) {
                    
                    $taskHelp = new Task;
                    
                    $taskHelp->Curator = $row['Name'] . " " . $row['LastName'] . " - ". $row['Position'];
                    
                }
                    
            }
        }

        $task->Curator = $taskHelp->Curator;

        return $task;
    }//GetTaskById
    public function addTask($Title, $Text, $StartDate, $EndDate, $idEmployee, $idCurator, $idProject, $idStatus){
        
        $sql = "INSERT INTO `Task` VALUES (DEFAULT, :TaskTitle, :TaskText, :TaskStart, :TaskEnd, :idEmployee, :idCurator, :idProject, :idStatus)";
        $query = $this->PDO->prepare($sql);

        $query->bindParam(":TaskTitle", $Title, PDO::PARAM_STR);
        $query->bindParam(":TaskText", $Text, PDO::PARAM_STR);
        $query->bindParam(":TaskStart", $StartDate, PDO::PARAM_STR);
        $query->bindParam(":TaskEnd", $EndDate, PDO::PARAM_STR);
        $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
        $query->bindParam(":idCurator", $idCurator, PDO::PARAM_INT);
        $query->bindParam(":idProject", $idProject, PDO::PARAM_INT);
        $query->bindParam(":idStatus", $idStatus, PDO::PARAM_INT);
        
        if ($query->execute()) {
            return 1;
        }
        return 0;
    }//addTask
   
    public function updateTask($id, $Title, $Text, $StartDate, $EndDate, $idEmployee, $idCurator, $idProject, $idStatus){
        
        $sql = "UPDATE Task SET TaskTitle = :TaskTitle, TaskText = :TaskText, TaskStart = :TaskStart, TaskEnd = :TaskEnd, idEmployee = :idEmployee, idCurator = :idCurator, idProject = :idProject, idStatusTasks = :idStatus WHERE idTask = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":TaskTitle", $Title, PDO::PARAM_STR);
        $query->bindParam(":TaskText", $Text, PDO::PARAM_STR);
        $query->bindParam(":TaskStart", $StartDate, PDO::PARAM_STR);
        $query->bindParam(":TaskEnd", $EndDate, PDO::PARAM_STR);
        $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
        $query->bindParam(":idCurator", $idCurator, PDO::PARAM_INT);
        $query->bindParam(":idProject", $idProject, PDO::PARAM_INT);
        $query->bindParam(":idStatus", $idStatus, PDO::PARAM_INT);
        
        if ($query->execute()) {
            return 1;
        }
        return 0;
    }//addProject

    public function GetAllTasksFromProject($idProject){

        $tasks = array();

        $sql = $sql = "SELECT * FROM Task 
        LEFT JOIN Employee          ON Task.idEmployee = Employee.id
        LEFT JOIN Career ON Task.idEmployee = Career.idEmployee
        LEFT JOIN Project      ON Task.idProject = Project.idProject
        LEFT JOIN StatusTasks     ON Task.idStatusTasks = StatusTasks.idStatusTasks
        WHERE Task.idProject = :idProject";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":idProject", $idProject, PDO::PARAM_INT);
            if ($query->execute()) {
                while ($row = $query->fetch()) {
                    $task = new Task;
                    $task->idTask = $row['idTask'];
                    $task->TaskTitle = $row['TaskTitle'];
                    $task->TaskText = $row['TaskText'];
                    $task->TaskStart = $row['TaskStart'];
                    $task->TaskEnd = $row['TaskEnd'];
                    $task->Employee = $row['Name'] . " " . $row['LastName'] . " - ". $row['Position'];
                    $task->idEmployee = $row['id'];
                    $task->Project = $row['ProjectNumber'];
                    $task->StatusTask = $row['StatusTasksTitle'];
                    $task->Curator = $row['idCurator'];
                    $task->Info = "exist";
                    $tasks[] = $task;
                }
                    
            }
        }
       
     
        usort($tasks, array('Task_Model', 'cmp'));
        
        for($i=1; $i < count($tasks); $i++){

            
            if($tasks[$i]->idEmployee == $tasks[$i-1]->idEmployee){
               
                
                
                if((strtotime($tasks[$i]->TaskStart) > strtotime($tasks[$i-1]->TaskStart)
                && strtotime($tasks[$i]->TaskStart) < strtotime($tasks[$i-1]->TaskEnd)) || 
                (strtotime($tasks[$i]->TaskEnd) > strtotime($tasks[$i-1]->TaskStart) && strtotime($tasks[$i]->TaskEnd) < strtotime($tasks[$i-1]->TaskEnd))
                || (strtotime($tasks[$i-1]->TaskStart) > strtotime($tasks[$i]->TaskStart)
                && strtotime($tasks[$i-1]->TaskStart) < strtotime($tasks[$i]->TaskEnd)) || 
                (strtotime($tasks[$i-1]->TaskEnd) > strtotime($tasks[$i]->TaskStart) && strtotime($tasks[$i-1]->TaskEnd) < strtotime($tasks[$i]->TaskEnd))){
    
                    $tasks[$i]->Info = '';
    
                }
                else{
                    $tasks[$i]->Info = '-1';
                }

                

            }
        }

        foreach($tasks as $task){
            $Today = strtotime(date("Y-m-d"));
            $Start = strtotime($task->TaskStart);
            $End = strtotime($task->TaskEnd); 

            $nextTwoWeeks  = $End - 14*86400;
            if($Today > $End){
                $task->Is_Past = "";
                $task->Is_Finish = "Aufgabe abgelaufen" . $task->TaskEnd;
            }

            if($Today >= $nextTwoWeeks && $Today < $End){
                $task->Is_Past = "Aufgabe läuft ab $task->TaskEnd";
                $task->Is_Finish = "";
            }

        }

        

       /*  echo("<pre>");
        var_dump($tasks);
        echo("</pre>"); */

        return $tasks;
    }//GetAllTasksFromProject

    private static function cmp($a, $b) {
        return strcmp($a->idEmployee, $b->idEmployee);
    }

    public function DeleteTask($id){

        $sql = "DELETE FROM Task WHERE idTask = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_STR);
       
        //$query->execute();
        if ($query->execute()){
            return 1;
        }

        return 0;
    }//DeleteTask

    public function DeleteEmployeeFromTask($idTask){
        $a = null;
        $sql = "UPDATE Task SET idEmployee = :idEmployee WHERE idTask = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $idTask, PDO::PARAM_INT);
        $query->bindParam(":idEmployee", $a, PDO::PARAM_INT);
        
        if ($query->execute()) {
            return 1;
        }
        return 0;

    }//DeleteEmployeeFromTask

    public function UpdateTaskDate($id, $startDate, $endDate){

        $sql = "UPDATE Task SET TaskStart = :TaskStart, TaskEnd = :TaskEnd WHERE idTask = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":TaskStart", $startDate, PDO::PARAM_STR);
        $query->bindParam(":TaskEnd", $endDate, PDO::PARAM_STR);

        if ($query->execute()) {
            return 1;
        }
        return 0;

    }//UpdateTaskDate

    public function GetAllTasksFromEmployee($idEmployee){

        $tasks = array();

        $sql = $sql = "SELECT * FROM Task 
        LEFT JOIN Employee          ON Task.idEmployee = Employee.id
        LEFT JOIN Career ON Task.idEmployee = Career.idEmployee
        LEFT JOIN Project      ON Task.idProject = Project.idProject
        LEFT JOIN StatusTasks     ON Task.idStatusTasks = StatusTasks.idStatusTasks
        WHERE Task.idEmployee = :idEmployee";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
            if ($query->execute()) {
                while ($row = $query->fetch()) {
                    $task = new Task;
                    $task->idTask = $row['idTask'];
                    $task->TaskTitle = $row['TaskTitle'];
                    $task->TaskText = $row['TaskText'];
                    $task->TaskStart = $row['TaskStart'];
                    $task->TaskEnd = $row['TaskEnd'];
                    $task->Employee = $row['Name'] . " " . $row['LastName'] . " - ". $row['Position'];
                    $task->idEmployee = $row['id'];
                    $task->idProject = $row['idProject'];
                    $task->Project = $row['ProjectNumber'];
                    $task->StatusTask = $row['StatusTasksTitle'];
                    $task->Curator = $row['idCurator'];
                    $task->Info = "exist";
                    $tasks[] = $task;
                }
                    
            }
        }
       
     
        usort($tasks, array('Task_Model', 'cmpProject'));
        
        for($i=1; $i < count($tasks); $i++){

            
            if($tasks[$i]->idProject == $tasks[$i-1]->idProject){
               
                
                
                if((strtotime($tasks[$i]->TaskStart) > strtotime($tasks[$i-1]->TaskStart)
                && strtotime($tasks[$i]->TaskStart) < strtotime($tasks[$i-1]->TaskEnd)) || 
                (strtotime($tasks[$i]->TaskEnd) > strtotime($tasks[$i-1]->TaskStart) && strtotime($tasks[$i]->TaskEnd) < strtotime($tasks[$i-1]->TaskEnd))
                || (strtotime($tasks[$i-1]->TaskStart) > strtotime($tasks[$i]->TaskStart)
                && strtotime($tasks[$i-1]->TaskStart) < strtotime($tasks[$i]->TaskEnd)) || 
                (strtotime($tasks[$i-1]->TaskEnd) > strtotime($tasks[$i]->TaskStart) && strtotime($tasks[$i-1]->TaskEnd) < strtotime($tasks[$i]->TaskEnd))){
    
                    $tasks[$i]->Info = '';
    
                }
                else{
                    $tasks[$i]->Info = '-1';
                }

                

            }
        }

        foreach($tasks as $task){
            $Today = strtotime(date("Y-m-d"));
            $Start = strtotime($task->TaskStart);
            $End = strtotime($task->TaskEnd); 

            $nextTwoWeeks  = $End - 14*86400;
            if($Today > $End){
                $task->Is_Past = "";
                $task->Is_Finish = "Aufgabe abgelaufen" . $task->TaskEnd;
            }

            if($Today >= $nextTwoWeeks && $Today < $End){
                $task->Is_Past = "Aufgabe läuft ab $task->TaskEnd";
                $task->Is_Finish = "";
            }

        }

        

       /* echo("<pre>");
        var_dump($tasks);
        echo("</pre>");  */

        return $tasks;
    }//GetAllTasksFromProject


    private static function cmpProject($a, $b) {
        return strcmp($a->idProject, $b->idProject);
    }


}