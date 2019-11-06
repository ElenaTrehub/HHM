<?php
include "application/models/model_client.php";
class Controller_DeleteClient extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $this->PDO = $pdo;

        $id = $_POST['idClient'];
        
        $currentClient = new Client_Model($this->PDO);
        $res = $currentClient->DeleteClient($id);
        if($res == 1){
            header('location: /HR/clientlist');
        }
    }
}