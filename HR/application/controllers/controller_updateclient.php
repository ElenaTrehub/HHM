<?php

include "application/models/model_client.php";

class Controller_UpdateClient extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $this->PDO = $pdo;


        if (isset($_POST['Title'])) {
            $Title = $_POST['Title'];
            $Contact = $_POST["Contact"];
            $Phone = $_POST["Phone"];
            $Email = $_POST["Email"];
            $Adress = $_POST["Adresse"];
            $Chief = $_POST["Chief"];

            
            $currentClient = new Client_Model($this->PDO);

            if($_POST["id"] == ''){
                $res = $currentClient->AddClient($Title, $Contact, $Phone, $Email, $Adress, $Chief);
                if($res == 1){
                    header('location: /HR/clientlist');
                }
                else{
                    header('location: /HR/editclient');
                }
            }
            else{

                $res = $currentClient->updateClient($_POST["id"], $Title, $Contact, $Phone, $Email, $Adress, $Chief);

                if($res == 1){
                    header('location: /HR/clientlist');
                }
                else{
                    header('location: /HR/editclient');
                }


            }
        }
    }
}