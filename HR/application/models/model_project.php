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
}