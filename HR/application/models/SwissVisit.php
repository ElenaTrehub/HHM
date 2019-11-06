<?php
class SwissVisit{
      public $idEmployee;
      public $StartDate;
      public $EndDate;
      public $Location;
      public $Accommodation;
      public $Goal;
      public $Group;
}
class SwissVisit_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;
    }//__construct

    public function GetVisitsFromEmployee($id){

        $visitArray = array();

        $sqlVisit = "SELECT * FROM SwissVisit where SwissVisit.idEmployee = :id ORDER BY StartDate";
            if ($queryVisit = $this->PDO->prepare($sqlVisit)){
                $queryVisit->bindParam(":id", $id, PDO::PARAM_STR);
    
                if ($queryVisit->execute()){
                    while ($rowVisit = $queryVisit->fetch()){
                        $visit = new SwissVisit();
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
        return $visitArray;

    }//GetAllRoles

   
}