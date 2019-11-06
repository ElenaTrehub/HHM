<?php

class Client{

    public $idClient;
    public $Title;
    public $Contact;
    public $Phone;
    public $Email;
    public $Adress;
    public $Chief;
    public $Projects = array();
}

class Client_Model extends Model{

    public function __construct($pdo){
        $this->PDO = $pdo;
    }//__construct

    public function GetAllClient(){

        $clients = array();

        $sql = "SELECT * FROM Client";
        if($queryClients = $this->PDO->prepare($sql)){
            if ($queryClients->execute()) {
                while ($rowClient = $queryClients->fetch()) {
                    $client = new Client;
                    $client->idClient = $rowClient['idClient'];
                    $client->Title = $rowClient['ClientTitle'];
                    $client->Contact = $rowClient['ClientContactPerson'];
                    $client->Phone = $rowClient['ClientPhone'];
                    $client->Email = $rowClient['ClientEmail'];
                    $client->Adress = $rowClient['ClientAdress'];
                    $client->Chief = $rowClient['ClientChief'];
                    $clients[] = $client;
                }
            }

        }

        return $clients;

    }//GetAllClient

    public function AddClient($Title, $Contact, $Phone, $Email, $Adress, $Chief){

        $sql = "INSERT INTO Client VALUES(Default, :ClientTitle, :ClientContact, :ClientPhone, :ClientEmail, :ClientAdress, :ClientChief  )";

        $queryClient = $this->PDO->prepare($sql);
        $queryClient->bindParam(":ClientTitle", $Title, PDO::PARAM_STR);
        $queryClient->bindParam(":ClientContact", $Contact, PDO::PARAM_STR);
        $queryClient->bindParam(":ClientPhone", $Phone, PDO::PARAM_STR);
        $queryClient->bindParam(":ClientEmail", $Email, PDO::PARAM_STR);
        $queryClient->bindParam(":ClientAdress", $Adress, PDO::PARAM_STR);
        $queryClient->bindParam(":ClientChief", $Chief, PDO::PARAM_STR);

        if ($queryClient->execute()) {
            return 1;
        }
        return 0;
        
    }//AddClient
    public function updateClient($id, $Title, $Contact, $Phone, $Email, $Adress, $Chief){

        $sql = "UPDATE Client SET ClientTitle = :ClientTitle, ClientContactPerson = :ClientContact, ClientPhone = :ClientPhone, ClientEmail = :ClientEmail, ClientAdress = :ClientAdress, ClientChief = :ClientChief WHERE idClient = :id";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":ClientTitle", $Title, PDO::PARAM_STR);
        $query->bindParam(":ClientContact", $Contact, PDO::PARAM_STR);
        $query->bindParam(":ClientPhone", $Phone, PDO::PARAM_STR);
        $query->bindParam(":ClientEmail", $Email, PDO::PARAM_STR);
        $query->bindParam(":ClientAdress", $Adress, PDO::PARAM_STR);
        $query->bindParam(":ClientChief", $Chief, PDO::PARAM_STR);
        
        if ($query->execute()) {
            return 1;
        }
        return 0;
        
    }//AddClient
    public function GetClientById($id){

        $sql = "SELECT * FROM Client WHERE idClient = :id";

        if($queryClient = $this->PDO->prepare($sql)){
            $queryClient->bindParam(":id", $id, PDO::PARAM_INT);
            if ($queryClient->execute()) {
                while ($rowClient = $queryClient->fetch()) {
                    $client = new Client;
                    $client->idClient = $rowClient['idClient'];
                    $client->Title = $rowClient['ClientTitle'];
                    $client->Contact = $rowClient['ClientContactPerson'];
                    $client->Phone = $rowClient['ClientPhone'];
                    $client->Email = $rowClient['ClientEmail'];
                    $client->Adress = $rowClient['ClientAdress'];
                    $client->Chief = $rowClient['ClientChief'];
                 
                }
            }

        }
        return $client;
    }//AddClient

    public function DeleteClient($id){
        $sql = "DELETE FROM Client WHERE idClient = :idClient";
        $query = $this->PDO->prepare($sql);
        $query->bindParam(':idClient', $id, PDO::PARAM_INT);
        $res = $query->execute();

        if($res){
            return 1;
        }
        return 0;
    }//DeleteClient
}