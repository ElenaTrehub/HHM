<?php

session_start();
include "application/models/model_project.php";

class Controller_ClientList extends Controller{

    public function action_index(){

        require_once "config.php";
        $this->PDO = $pdo;

        $info = array();

        $currentClient = new Client_Model($this->PDO);
        $clientList = $currentClient->GetAllClient();

        $project = new Project_Model($this->PDO);
        $projectList = $project->GetAllProjects();

        foreach ($clientList as $client) {
            foreach ($projectList as $project) {
                if ($client->idClient == $project->client->idClient) {
                    $client->Projects[] = $project;
                }
            }    
        }

        $this->view->clientList = $clientList;
        $this->view->generate('clientlist_view.php', 'template_view.php');
    }
    
}