<?php
include "application/models/model_client.php";

class Controller_EditClient extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        $this->PDO = $pdo;
        
        if (isset($_POST['idClient'])){
            $id = $_POST['idClient'];                    
        }
        else{
            $id = '';
        }

        if($id != ''){

            $client = new Client_Model($this->PDO);
            $currentClient = $client->GetClientById($id);
            $this->view->client = $currentClient;
        }
      
 
        $this->view->clientId = $id;
        $this->view->upload_err = "";   
        $this->view->passport_upload_err = "";           
        
        $this->view->generate('editclient_view.php', 'template_view.php');

    }//action_index




}//Controller_EditProject