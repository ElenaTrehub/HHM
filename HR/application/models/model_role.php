<?php

class Role{

    public $idRole;
    public $RoleTitle;
}

class Role_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;;
    }//__construct

    public function GetAllRoles(){

        $roles = array();

        $sql = "SELECT * FROM Role";
        if($queryRoles = $this->PDO->prepare($sql)){
            if ($queryRoles->execute()) {
                while ($rowRole = $queryRoles->fetch()) {
                    $role = new Role;
                    $role->idRole = $rowRole['idRole'];
                    $role->RoleTitle = $rowRole['RoleTitle'];
                    
                    $roles[] = $role;
                }
            }

        }

        return $roles;

    }//GetAllRoles

   
}