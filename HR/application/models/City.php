<?php

class City{

    public $idCity;
    public $titleCity;
}

class City_Model extends Model{

    public function __construct($pdo){
        //require_once "config.php";
        $this->PDO = $pdo;
    }//__construct

    public function GetAllCities(){

        $cites = array();

        $sqlCity = "SELECT * FROM Cities";
        if($queryCites = $this->PDO->prepare($sqlCity)){
            if ($queryCites->execute()) {
                while ($rowCity = $queryCites->fetch()) {
                    $city = new City;
                    $city->idCity = $rowCity['idCity'];
                    $city->titleCity = $rowCity['cityTitle'];

                    $cites[] = $city;
                }
            }

        }

        return $cites;

    }//GetAllRoles

   
}