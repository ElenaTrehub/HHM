<?php
include "application/models/model_task.php";
include "application/models/Employee.php";
include "application/models/model_statustask.php";
class Controller_UpdateTasksInProject extends Controller
{

	function action_index()
	{
        require_once "config.php";
        $this->PDO = $pdo;
        var_dump($_POST);
        $employees = array();
        $employee = new Employee_Model($this->PDO);
        $employees = $employee->GetAllEmployeeForTask(); 

        $statuses = array();
        $status = new StatusTask_Model($this->PDO);
        $statuses = $status->GetAllTaskStatuses();

        
       $idProject = $_POST["idProject"];
        $tasks = array();
        if(isset($_POST["taskInProj"])){
            $tasks = $_POST["taskInProj"];
        }
        else{
            $tasks = [];
        }

        try {
            $this->PDO->beginTransaction();


            $sqlClearTasks = "DELETE FROM Task WHERE idProject = :id";
            if ($queryClearTasks = $this->PDO->prepare($sqlClearTasks)) {
                $queryClearTasks->bindParam(":id", $idProject, PDO::PARAM_INT);
                $queryClearTasks->execute();
            }

            if(count($tasks)>0){
                $tasksArray = array_chunk($tasks, 8);
                var_dump($tasksArray);
                for ($i=0; $i < count($tasksArray); $i++) { 
                    $idEmployee = null;
                    $employee_info = trim($tasksArray[$i][7]);
        
                    if($employee_info != "-"){
                        
                        foreach($employees as $emp){
                        
                            $array = explode(" - ", $employee_info);
                            $position = $array[1];
                            $nameArray = explode(" ", $array[0]);
                            $name = $nameArray[0];
                            $surname = $nameArray[1];
                            
                            if ($position == $emp->Position && $name == $emp->Name && $surname == $emp->LastName){
                
                                $idEmployee = $emp->Id;
                                break;
                            }
                            
                        }
    
                    }

                    $idStatus = null;
                    $status = $tasksArray[$i][6];
        
                    if($status != ""){
                        
                        foreach($statuses as $stat){
                            
                            if ($status == $stat->statusTaskTitle){
                
                                $idStatus = $stat->idStatusTask;
                                break;
                            }
                            
                        }
    
                    }


                    $query = $this->PDO->prepare("INSERT INTO `Task` VALUES (DEFAULT, :TaskTitle, :TaskText, :TaskStart, :TaskEnd, :idEmployee, :idCurator, :idProject, :idStatus)");
                
                    $query->bindParam(":TaskTitle",       $tasksArray[$i][1], PDO::PARAM_STR);
                    $query->bindParam(":TaskText",        $tasksArray[$i][2], PDO::PARAM_STR);
                    $query->bindParam(":TaskStart",       $tasksArray[$i][3], PDO::PARAM_STR);
                    $query->bindParam(":TaskEnd",         $tasksArray[$i][4], PDO::PARAM_STR);
                    $query->bindParam(":idEmployee",      $idEmployee, PDO::PARAM_INT);
                    $query->bindParam(":idCurator",       $tasksArray[$i][5], PDO::PARAM_INT);
                    $query->bindParam(":idProject",       $idProject, PDO::PARAM_INT);
                    $query->bindParam(":idStatus",       $idStatus, PDO::PARAM_INT);
                    $query->execute();    
                }
            }


            $this->PDO->commit();
            
            header('location: /HR/editproject');
           
        } 
        catch (Exception $e) {
            $this->PDO->rollback();
        }



        

        
        

        
        

        
    }
}