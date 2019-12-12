<?php
include "application/models/Employee.php";
include "application/models/model_client.php";
class Project{
    public $IdProject;
    public $Title;
    public $Start;
    public $End;
    public $Destination;
    public $Description;
    public $Curator;
    public $Client;
    public $Number;
    public $Status;
}

class Project_Model extends Model{

    public function __construct($pdo){
        $this->PDO = $pdo;
    }//__construct

    public function addProject($ProjectTitle, $ProjectStart, $ProjectEnd, $ProjectDestination, $ProjectDescription, $idEmployee, $idClient, $ProjectNumber, $idStatus){
        
        $sql = "INSERT INTO `Project` VALUES (DEFAULT, :ProjectTitle, :ProjectStart, :ProjectEnd, :ProjectDestination, :ProjectDescription, :idEmployee, :idClient, :ProjectNumber, :idStatus )";
        $query = $this->PDO->prepare($sql);

        $query->bindParam(":ProjectTitle", $ProjectTitle, PDO::PARAM_STR);
        $query->bindParam(":ProjectStart", $ProjectStart, PDO::PARAM_STR);
        $query->bindParam(":ProjectEnd", $ProjectEnd, PDO::PARAM_STR);
        $query->bindParam(":ProjectDestination", $ProjectDestination, PDO::PARAM_STR);
        $query->bindParam(":ProjectDescription", $ProjectDescription, PDO::PARAM_STR);
        $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
        $query->bindParam(":idClient", $idClient, PDO::PARAM_INT);
        $query->bindParam(":ProjectNumber", $ProjectNumber, PDO::PARAM_STR);
        $query->bindParam(":idStatus", $idStatus, PDO::PARAM_INT);

        if ($query->execute()) {
            return 1;
        }
        return 0;
    }//addProject

    public function updateProject($id, $ProjectTitle, $ProjectStart, $ProjectEnd, $ProjectDestination, $ProjectDescription, $idEmployee, $idClient, $ProjectNumber, $idStatus){
        
        $sql = "UPDATE Project SET ProjectTitle = :ProjectTitle, ProjectStart = :ProjectStart, ProjectEnd = :ProjectEnd, ProjectDestination = :ProjectDestination, ProjectDescription = :ProjectDescription, idEmployee = :idEmployee, idClient = :idClient, ProjectNumber = :ProjectNumber, idStatus = :idStatus WHERE idProject = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":ProjectTitle", $ProjectTitle, PDO::PARAM_STR);
        $query->bindParam(":ProjectStart", $ProjectStart, PDO::PARAM_STR);
        $query->bindParam(":ProjectEnd", $ProjectEnd, PDO::PARAM_STR);
        $query->bindParam(":ProjectDestination", $ProjectDestination, PDO::PARAM_STR);
        $query->bindParam(":ProjectDescription", $ProjectDescription, PDO::PARAM_STR);
        $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
        $query->bindParam(":idClient", $idClient, PDO::PARAM_INT);
        $query->bindParam(":ProjectNumber", $ProjectNumber, PDO::PARAM_STR);
        $query->bindParam(":idStatus", $idStatus, PDO::PARAM_INT);
        
        if ($query->execute()) {
            return 1;
        }
        return 0;
    }//addProject

    public function GetProjectById($id){

        $sql = $sql = "SELECT * FROM Project 
        LEFT JOIN Client            ON Project.idClient = Client.idClient
        LEFT JOIN Employee          ON Project.idEmployee = Employee.id
        LEFT JOIN StatusProject     ON Project.idStatus = StatusProject.idStatusProject
        WHERE Project.idProject = :id";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            if ($query->execute()) {
                while ($row = $query->fetch()) {
                    $project = new Project;
                    $project->IdProject = $row['idProject'];
                    $project->Title = $row['ProjectTitle'];
                    $project->Start = $row['ProjectStart'];
                    $project->End = $row['ProjectEnd'];
                    $project->Destination = $row['ProjectDestination'];
                    $project->Description = $row['ProjectDescription'];
                    $project->Number = $row['ProjectNumber'];
                    $project->Curator = $row['Name'] . " " . $row['LastName'];
                    $project->Client = $row['ClientTitle'];
                    $project->Status = $row['StatusProjectTitle'];
                }
            }
        }

        return $project;
    }//GetProjectById
   


    public function GetAllProjects(){

        $info = array();
        $sql = "SELECT * FROM Project
            LEFT JOIN Employee          ON Project.idEmployee = Employee.id
            LEFT JOIN PersonalData      ON Project.idEmployee = PersonalData.idEmployee
            LEFT JOIN Client            ON Project.idClient = Client.idClient
            LEFT JOIN Career            ON Project.idEmployee = Career.idEmployee
            LEFT JOIN G17               ON Project.idEmployee = G17.idEmployee
            LEFT JOIN HHM               ON Project.idEmployee = HHM.idEmployee
            LEFT JOIN StatusProject     ON Project.idStatus = StatusProject.idStatusProject";

        if($query = $this->PDO->prepare($sql)){
            if ($query->execute()) {
                while ($row = $query->fetch()) {

                    $project = new Project;
                    $project->IdProject = $row['idProject'];
                    $project->Title = $row['ProjectTitle'];
                    $project->Start = $row['ProjectStart'];
                    $project->End = $row['ProjectEnd'];
                    $project->Destination = $row['ProjectDestination'];
                    $project->Description = $row['ProjectDescription'];
                    $project->Number = $row['ProjectNumber'];
                    $project->Status = $row['StatusProjectTitle'];

                    $curator = new Employee();
                    $curator->Id = $row['idEmployee'];
                    $curator->Name = $row['Name'];
                    $curator->LastName = $row['LastName'];
                    $curator->Photo = $row['Photo'];
                    $curator->Position = $row['Position'];
                    $curator->G17_email = $row['G17_E-Mail'];
                    $curator->G17_initials = $row['G17_initials'];
                    $curator->HHM_email = $row['HHM_E-Mail'];
                    $curator->HHM_initials = $row['HHM_Initials'];

                    $client = new Client;
                    $client->idClient = $row['idClient'];
                    $client->Title = $row['ClientTitle'];
                    $client->Contact = $row['ClientContactPerson'];
                    $client->Phone = $row['ClientPhone'];
                    $client->Email = $row['ClientEmail'];
                    $client->Adress = $row['ClientAdress'];
                    $client->Chief = $row['ClientChief'];


                    $obj = new stdClass();
                    $obj->project = $project;
                    $obj->curator = $curator;
                    $obj->client = $client;




                    $info[] = $obj;
                }
            }

        }
        return $info;
    }//GetAllProjects

    public function DeleteProject($id){

        $sql = "DELETE FROM Project WHERE idProject = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_STR);
       
        //$query->execute();
        if ($query->execute()){
            return 1;
        }

        return 0;
    }//DeleteProject

    public function GetProjectsForTask(){

        $projects = array();

        $sql = "SELECT * FROM Project";

        if($query = $this->PDO->prepare($sql)){
            if ($query->execute()) {
                while ($row = $query->fetch()) {

                    $project = new Project;
                    $project->IdProject = $row['idProject'];
                    $project->Title = $row['ProjectTitle'];
                    $project->Start = $row['ProjectStart'];
                    $project->End = $row['ProjectEnd'];
                    $project->Destination = $row['ProjectDestination'];
                    $project->Description = $row['ProjectDescription'];
                    $project->Number = $row['ProjectNumber'];
                    

                    

                    $projects[] = $project;
                }
            }

        }
        return $projects;
        
    }//GetProjectsForTask
    public function GetProjectIdFromNumber($number){
        $id = "";
        $sql = "SELECT * FROM Project WHERE ProjectNumber = :number";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":number", $number, PDO::PARAM_STR);
            if ($query->execute()) {
                while ($row = $query->fetch()) {
                    $id = $row['idProject'];
                }
            }
        }

        return $id;
    }//GetProjectIdFromNumber

    public function UpdateEmployeesInProject($projectId, $idEmployees){
        $res = 0;
        try {
            $this->PDO->beginTransaction();

            if(count($idEmployees)>0){


                $query = $this->PDO->prepare("DELETE FROM ProjectEmployee WHERE idProject = :id");
                $query->bindParam(":id", $projectId, PDO::PARAM_INT);
                $query->execute(); 


        
                for ($i=0; $i < count($idEmployees); $i++) { 
                    
                    $queryAddEmp = $this->PDO->prepare("INSERT INTO `ProjectEmployee` VALUES (DEFAULT, :idProject, :idEmployee)");
    
                    $queryAddEmp->bindParam(":idProject", $projectId, PDO::PARAM_INT);            
                    $queryAddEmp->bindParam(":idEmployee", $idEmployees[$i], PDO::PARAM_INT);
    
                    $queryAddEmp->execute();    
                }
            }

            $this->PDO->commit();
            $res = 1;
            return $res;
        }
        catch (Exception $e) {
            $this->PDO->rollback();
            $res = -1;
            return $res;
        } 

    }//UpdateEmployeesInProject

    public function GetEmployeesFromProject($id){
        $idCurrentProject = $id;
        
        $employeeIds = array();
        $sql = "SELECT * FROM ProjectEmployee WHERE idProject = :idProject";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":idProject", $id, PDO::PARAM_STR);
            if ($query->execute()) {
                while ($row = $query->fetch()) {
                    $id = $row['idEmployee'];

                    $employeeIds[] = $id;
                }
            }
        }

        $employees = array();

        if(count($employeeIds)>0){

            foreach($employeeIds as $id){

                $sql = "SELECT * FROM Employee
                LEFT JOIN Career ON Employee.id = Career.idEmployee
                WHERE Employee.id = :id";

                if ($query = $this->PDO->prepare($sql)) {
                    $query->bindParam(":id", $id, PDO::PARAM_INT);
                    if ($query->execute()) {
                        while ($row = $query->fetch()) {
                            $employee = new Employee;
                            $employee->Id = $row['id'];
                            $employee->Name = $row['Name'];
                            $employee->LastName = $row['LastName'];
                            $employee->Position = $row['Position'];

                            $employees[] = $employee;
                        }
                    }
                }
            }

        }
        
        foreach($employees as $emp){

            $tasks = array();
            $current_tasks = array();
            $sql = "SELECT * FROM Task WHERE idEmployee = :id";
            
            if ($query = $this->PDO->prepare($sql)) {
                $query->bindParam(":id", $emp->Id, PDO::PARAM_INT);
                if ($query->execute()) {
                    while ($row = $query->fetch()) {
                        $task = new Task;
                        $task->TaskStart = $row['TaskStart'];
                        $task->TaskEnd = $row['TaskEnd'];
                        $task->Project = $row['idProject'];
                        
                        if($task->Project == $idCurrentProject){
                            $current_tasks[] = $task;
                        }
                        else{
                            $tasks[] = $task;
                        }
                    }
                }
            }

            

            if(count($tasks) == 0 && count($current_tasks) == 0){
                
                $emp->Emp_Busy = "Ist frei";
                $emp->Is_Busy = 0;
                $emp->Is_Busy_Current = 0;
            }
            else if(count($current_tasks)>0){
                $Today = strtotime(date("Y-m-d"));
                $maxDate = $Today;
                foreach($current_tasks as $task){
                    $Start = strtotime($task->TaskStart);
                    $End = strtotime($task->TaskEnd); 
                       
                    if($Today > $Start && $Today < $End){
                        if($End > $maxDate){
                            $maxDate = $End;
                            $date = $task->TaskEnd;
                        }
                        //var_dump($idCurrentProject);
                        //var_dump($task->Project);
                       
                        $emp->Emp_Busy = "Beschäftigt im aktuellen Projekt vor ".$date;
                        $emp->Is_Busy = 0;
                        $emp->Is_Busy_Current = 1;
                        
                    }
                    else{
                        $emp->Emp_Busy = "Ist frei";
                        $emp->Is_Busy = 0;
                        $emp->Is_Busy_Current = 0;
                    }
                }
                
                if($emp->Is_Busy_Current == 0 && count($tasks)>0){
                    $Today = strtotime(date("Y-m-d"));
                    $maxDate = $Today;
                    foreach($tasks as $task){
                        $Start = strtotime($task->TaskStart);
                        $End = strtotime($task->TaskEnd); 
                        
                        if($Today > $Start && $Today < $End){
                            if($End > $maxDate){
                                $maxDate = $End;
                                $date = $task->TaskEnd;
                            }
                            var_dump($task);
                            //var_dump($task->Project);
                            
                            $emp->Emp_Busy = "Beschäftigt in anderen Projekten vor ".$date;
                            $emp->Is_Busy = 1;
                            $emp->Is_Busy_Current = 0;
                        }
                        else{
                            $emp->Emp_Busy = "Ist frei";
                            $emp->Is_Busy = 0;
                            $emp->Is_Busy_Current = 0;
                        }
                    }
                }
            } 
            else if(count($tasks)>0){
                $Today = strtotime(date("Y-m-d"));
                $maxDate = $Today;
                
                foreach($tasks as $task){
                    $Start = strtotime($task->TaskStart);
                    $End = strtotime($task->TaskEnd); 
                       
                    if($Today > $Start && $Today < $End){
                        if($End > $maxDate){
                            $maxDate = $End;
                            $date = $task->TaskEnd;
                        }
                        //var_dump($idCurrentProject);
                        //var_dump($task->Project);
                        
                        $emp->Emp_Busy = "Beschäftigt in anderen Projekten vor ".$date;
                        $emp->Is_Busy = 1;
                        $emp->Is_Busy_Current = 0;
                        
                    }
                    else{
                        $emp->Emp_Busy = "Ist frei";
                        $emp->Is_Busy = 0;
                        $emp->Is_Busy_Current = 0;
                        
                    }
                }
            }
            

        }

        return $employees;

    }//GetEmployeesFromProject

    public function DeleteEmployeeFromProject($idProject, $idEmployee){
        try {
            $this->PDO->beginTransaction();

            $query = $this->PDO->prepare("DELETE FROM ProjectEmployee WHERE idProject = :id AND idEmployee = :idEmployee");
            $query->bindParam(":id", $idProject, PDO::PARAM_INT);
            $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
            $query->execute();

            $id = null;

            $query = $this->PDO->prepare("UPDATE Task SET idEmployee = :id WHERE idProject = :idProject AND idEmployee = :idEmployee");
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->bindParam(":idProject", $idProject, PDO::PARAM_INT);
            $query->bindParam(":idEmployee", $idEmployee, PDO::PARAM_INT);
            $query->execute();

            $this->PDO->commit();
            $res = 1;
            //var_dump( $query->execute());
            return $res;
        }
        catch (Exception $e) {
            $this->PDO->rollback();
            $res = -1;
            return $res;
        }

    }//DeleteEmployeeFromProject
}