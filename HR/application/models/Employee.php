<?php
include "application/models/Child.php";
include "application/models/City.php";
include "application/models/SwissVisit.php";
include "application/models/model_role.php";
class Employee
{
    public $Id;
    public $Name;
    public $LastName;
    public $Photo;
    public $Role;

    public $BirthDate;
    public $CivilState;
    public $Address;
	public $PLZ;
	public $Place;
    public $Phone;
   
    public $Position;
    public $StartDate;
    public $Comment;
    public $Salary;
    public $Status;

    public $Pass_Name;
    public $Pass_LastName;
    public $Pass_Number;
    public $Pass_Expired;
    public $Pass_Photo;

    public $Children = array();

    public $G17_email;
    public $G17_initials;

    public $HHM_email;
    public $HHM_initials;

    public $SwissVisit = array();
}

class Employee_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;
    }//__construct

    public function GetEmployeeById($id){

        $childArray = array();
        $child = new Child_Model($this->PDO);
        $childArray = $child->GetAllChildren($id);
            

        $visitArray = array();
        $visit = new SwissVisit_Model($this->PDO);
        $visitArray = $visit->GetVisitsFromEmployee($id);
        

        $sql = "SELECT * FROM Employee
                LEFT JOIN PersonalData ON Employee.id = PersonalData.idEmployee
                LEFT JOIN Career ON Employee.id = Career.idEmployee
                LEFT JOIN ForeignPassport ON Employee.id = ForeignPassport.idEmployee
                LEFT JOIN G17 ON Employee.id = G17.idEmployee
                LEFT JOIN HHM ON Employee.id = HHM.idEmployee
                LEFT JOIN SwissVisit ON Employee.id = SwissVisit.idEmployee
                LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity
                LEFT JOIN Role ON Role.idRole = Employee.idRole
                WHERE Employee.id = :id";
    
            if ($query = $this->PDO->prepare($sql)) {
                $query->bindParam(":id", $id, PDO::PARAM_STR);
                if ($query->execute()) {
                    while ($row = $query->fetch()) {
                        $employee = new Employee;
                        $employee->Id = $row['id'];
                        $employee->Name = $row['Name'];
                        $employee->LastName = $row['LastName'];
                        //$employee->Photo = isset($_SESSION['employeePhotoSrc']) ? $_SESSION['employeePhotoSrc'] : $row['Photo'];
                        $employee->Photo = $row['Photo'];
                        $employee->Role = $row['RoleTitle'];
                        //-----Personal Data
                        $employee->BirthDate = $row['BirthDate'];
                        $employee->CivilState = $row['CivilState'];
                        $employee->Address = $row['Address'];
                        $employee->PLZ = $row['PLZ'];

                        $employee->Place = $row['cityTitle'];
                        //$employee->Place = $row['Place'];
                        $employee->Phone = $row['Phone'];
    
                        //-----Career                    
                        $employee->Position = $row['Position'];
                        $employee->StartDate = $row['CareerStart'];
                        $employee->Comment = $row['Comment'];                   
                        $employee->Salary = $row['Salary'];
                        $employee->Status = $row['Status'];
    
                        //-----Passport
                        $employee->Pass_Name = $row['PassName'];
                        $employee->Pass_LastName = $row['PassLastName'];
                        $employee->Pass_Number = $row['Number'];
                        $employee->Pass_Expired = $row['Valid'];
                        $employee->Pass_Photo = $row['PhotoPassport'];

                        foreach ($childArray as $child) {
                            if ($row['id'] == $child->idParent) {
                                $employee->Children[] = $child;
                            }
                        }
    
                        //-----G17
                        $employee->G17_email = $row['G17_E-Mail'];
                        $employee->G17_initials = $row['G17_initials'];
    
                        //-----H17
                        $employee->HHM_email = $row['HHM_E-Mail'];
                        $employee->HHM_initials = $row['HHM_Initials'];
    
                        foreach ($visitArray as $visit){
                            if ($row['id'] == $visit->idEmployee){
                                $employee->SwissVisit[] = $visit;
                            }
                        }
                        
                    }
                }
            }

        return $employee;

    }//GetEmployeeById

    public function GetAllProjectManager(){

        $id = 3;

        $projectManagers = array();

        $sql = "SELECT * FROM Employee 
        LEFT JOIN Role ON Role.idRole = Employee.idRole
        WHERE Employee.idRole = :id";
        if ($query = $this->PDO->prepare($sql)) {
            if ($query = $this->PDO->prepare($sql)) {
                $query->bindParam(":id", $id, PDO::PARAM_INT);
                if ($query->execute()) {
                    while ($row = $query->fetch()) {
                        $employee = new Employee;
                        $employee->Id = $row['id'];
                        $employee->Name = $row['Name'];
                        $employee->LastName = $row['LastName'];
                        //$employee->Photo = isset($_SESSION['employeePhotoSrc']) ? $_SESSION['employeePhotoSrc'] : $row['Photo'];
                        $employee->Photo = $row['Photo'];
                        $employee->Role = $row['RoleTitle'];

                        $projectManagers[] = $employee;
                    }
                }
            }
        }
        return $projectManagers;
    }//GetAllProjectManager

    public function GetAllEmployeeForTask(){

        $employees = array();

        $sql = "SELECT * FROM Employee 
        LEFT JOIN Career ON Employee.id = Career.idEmployee";

        if ($query = $this->PDO->prepare($sql)) {
            if ($query = $this->PDO->prepare($sql)) {
            
                if ($query->execute()) {
                    while ($row = $query->fetch()) {
                        $employee = new Employee;
                        $employee->Id = $row['id'];
                        $employee->Name = $row['Name'];
                        $employee->LastName = $row['LastName'];
                        //$employee->Photo = isset($_SESSION['employeePhotoSrc']) ? $_SESSION['employeePhotoSrc'] : $row['Photo'];
                        $employee->Position = $row['Position'];
                       
                        $employees[] = $employee;
                    }
                }
            }
        }
        return $employees;
    }//GetAllEmployeeForTask
   
}