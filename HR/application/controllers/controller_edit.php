<?php
include "application/models/Employee.php";


class Controller_Edit extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        $this->PDO = $pdo;
    
        if (isset($_POST['idEmployee'])){
            $id = $_POST['idEmployee'];                    
        }
        else if (isset($_SESSION['employeeID'])){
            $id = $_SESSION['employeeID'];  
        }
        else{
            $id = '';
        }

        $roles = array();
        $role = new Role_Model($this->PDO);
        $roles = $role->GetAllRoles();

        $cites = array();
        $city = new City_Model($this->PDO);
        $cites = $city->GetAllCities();

        

        if($id != ''){
    
            $employee = new Employee_Model($this->PDO);
            $curentEmployee = $employee->GetEmployeeById($id);

            $this->view->employee = $curentEmployee;
            
        }
        $this->view->cities = $cites;
        $this->view->roles = $roles;
       
        $this->view->employeeId = $id;
        $this->view->upload_err = "";   
        $this->view->passport_upload_err = "";           
        
        $this->view->generate('edit_view.php', 'template_view.php');
       

    }
}
