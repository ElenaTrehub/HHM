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
    public $Comment1;
    public $Comment2;
    public $Comment3;
    public $Salary;
    public $Status;
    public $Diplom_Photo;
    public $Productive;
    public $OverTime;
    public $W_End;

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
                        $employee->Photo = strlen($row['Photo']) == 0 ? "/images/user.png" : "/HR/employeePhoto/employee_240/".$row['Photo'];
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
                        $employee->Comment1 = $row['Comment1'];
                        $employee->Comment2 = $row['Comment2'];
                        $employee->Comment3 = $row['Comment3'];                   
                        $employee->Salary = $row['Salary'];
                        $employee->Status = $row['Status'];
                        $employee->Diplom_Photo = $row['PhotoDiplom'];
                        $employee->Productive = $row['Productive'];
                        $employee->OverTime = $row['OverTime'];
                        $employee->W_End = $row['W_End'];
    
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
                        
                        $employee->Photo = strlen($row['Photo']) == 0 ? "/images/user.png" : "/HR/employeePhoto/employee_60/".$row['Photo'];
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
                        $employee->Photo = strlen($row['Photo']) == 0 ? "/images/user.png" : "/HR/employeePhoto/employee_60/".$row['Photo'];
                        $employee->Position = $row['Position'];
                       
                        $employees[] = $employee;
                    }
                }
            }
        }
        return $employees;
    }//GetAllEmployeeForTask

    public function GetEmployeesFromRroject($idProject){

        $employees = array();

        $sql = $sql = "SELECT * FROM Task 
        LEFT JOIN Employee          ON Task.idEmployee = Employee.id
        LEFT JOIN Career ON Task.idEmployee = Career.idEmployee
        WHERE Task.idProject = :idProject";

        if ($query = $this->PDO->prepare($sql)) {
            $query->bindParam(":idProject", $idProject, PDO::PARAM_INT);
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

        $employeeList = array();
        $employeeList[] = $employees[0];
        usort($employees, array('Employee_Model', 'cmp'));

        for($i=1; $i < count($employees); $i++){

            if($employees[$i]->Id != $employees[$i-1]->Id){
                
                $employeeList[] = $employees[$i];

            }

        }
        
        return $employeeList;
        
    }//GetEmployeesFromRroject

    private static function cmp($a, $b) {
        return strcmp($a->Id, $b->Id);
    }

    public function getAllEmployee(){

        $empArray = array();
        $childArray = array();
        $visitArray = array();

        $sql = "SELECT * FROM Employee             
        LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee
        LEFT JOIN Career            ON Employee.id = Career.idEmployee
        LEFT JOIN ForeignPassport   ON Employee.id = ForeignPassport.idEmployee			
        LEFT JOIN G17               ON Employee.id = G17.idEmployee
        LEFT JOIN HHM               ON Employee.id = HHM.idEmployee
        LEFT JOIN Cities ON Cities.idCity = PersonalData.idCity";
        if (isset($_SESSION['loggedin'])) {
              $sqlChildren = "SELECT * FROM Children";
              if ($queryChildren = $this->PDO->prepare($sqlChildren)) {
                    if ($queryChildren->execute()) {
                          while ($rowChild = $queryChildren->fetch()) {
                                $child = new Child;
                                $child->idParent = $rowChild['idEmployee'];
                                $child->ChildName = $rowChild['ChildName'];
                                $child->ChildLastName = $rowChild['ChildLastName'];
                                $child->ChildBirthday = $rowChild['Birth'];
                                $childArray[] = $child;
                          }
                    }
              }

              $sqlSwissVisit = "SELECT * FROM SwissVisit";
              if ($querySwissVisit = $this->PDO->prepare($sqlSwissVisit)) {
                    if ($querySwissVisit->execute()) {
                          while ($rowVisit = $querySwissVisit->fetch()) {
                                $visit = new SwissVisit;
                                $visit->idEmployee = $rowVisit['idEmployee'];
                                $visit->StartDate = $rowVisit['StartDate'];
                                $visit->EndDate = $rowVisit['EndDate'];
                                $visit->Location = $rowVisit['Location'];
                                $visit->Accommodation = $rowVisit['Accommodation'];
                                $visit->Goal = $rowVisit['Goal'];
                                $visit->Group = $rowVisit['Group'];

                                $visitArray[] = $visit;
                          }
                    }
              }

              if ($query = $this->PDO->prepare($sql)) {
                    if ($query->execute()) {
                          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                $employee = new Employee;
                                $employee->Id = $row['id'];
                                $employee->Name = $row['Name'];
                                $employee->LastName = $row['LastName'];
                                $employee->Photo = strlen($row['Photo']) == 0 ? "/HR/images/user.png" : "/HR/employeePhoto/employee_60/".$row['Photo'];
                                
                                //-----Personal Data
                                $employee->BirthDate = $row['BirthDate'];
                                $employee->CivilState = $row['CivilState'];
                                $employee->Address = $row['Address'];
                                $employee->PLZ = $row['PLZ'];
                                $employee->Place = $row['cityTitle'];
                                $employee->Phone = $row['Phone'];

                                //-----Career
                                $employee->Position = $row['Position'];
                                $employee->StartDate = $row['CareerStart'];
                                $employee->Comment1 = $row['Comment1'];
                                $employee->Comment2 = $row['Comment2'];
                                $employee->Comment3 = $row['Comment3']; 
                                $employee->Salary = $row['Salary'];
                                $employee->Status = $row['Status'];
                                $employee->Diplom_Photo = $row['PhotoDiplom'];
                                $employee->Productive = $row['Productive'];
                                $employee->OverTime = $row['OverTime'];
                                $employee->W_End = $row['W_End'];

                                //-----Passport
                                $employee->Pass_Name = $row['PassName'];
                                $employee->Pass_LastName = $row['PassLastName'];
                                $employee->Pass_Number = $row['Number'];
                                $employee->Pass_Expired = $row['Valid'];

                                foreach ($childArray as $child) {
                                      if ($row['id'] == $child->idParent && $child->ChildName != "") {
                                            $employee->Children[] = $child;
                                      }
                                }

                                //-----G17
                                $employee->G17_email = $row['G17_E-Mail'];
                                $employee->G17_initials = $row['G17_initials'];

                                //-----H17
                                $employee->HHM_email = $row['HHM_E-Mail'];
                                $employee->HHM_initials = $row['HHM_Initials'];

                                foreach ($visitArray as $visit) {
                                      if ($row['idEmployee'] == $visit->idEmployee) {
                                            $employee->SwissVisit[] = $visit;
                                      }
                                }
                                
                                $empArray[] = $employee;
                          }
                    }
              }
              //echo('<pre>');print_r($empArray);echo('<pre>');

        }
        return $empArray;      
  }//getAllEmployee
   
}