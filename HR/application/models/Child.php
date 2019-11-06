<?php

class Child{
    public $idParent;
    public $ChildName;
    public $ChildLastName;
    public $ChildBirthday;
}

class Child_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;
    }//__construct

    public function GetAllChildren($id){

        $childArray = array();

        $sqlChildren = "SELECT * FROM Children where Children.idEmployee = :id";
            if ($queryChildren = $this->PDO->prepare($sqlChildren)) {
                $queryChildren->bindParam(":id", $id, PDO::PARAM_STR);
    
                if ($queryChildren->execute()) {
                    while ($rowChild = $queryChildren->fetch()) {
                        $child = new Child;
                        $child->idChild = $rowChild['idChildren'];
                        $child->idParent = $rowChild['idEmployee'];
                        $child->ChildName = $rowChild['ChildName'];
                        $child->ChildLastName = $rowChild['ChildLastName'];
                        $child->ChildBirthday = $rowChild['Birth'];
    
                        $childArray[] = $child;
                    }
                }
            }
    

        return $childArray;

    }//GetAllRoles

   
}