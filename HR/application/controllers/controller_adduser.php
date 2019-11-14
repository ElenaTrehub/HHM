<?php
include "application/models/model_role.php";
class Controller_AddUser extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $user_email = "";
        $user_role = "";

        $useremail_err = "";
        $role_err = "";

        $roles = array();
        $role = new Role_Model($pdo);
        $roles = $role->GetAllRoles();

        if (!empty($_POST['useremail'])){
            $user_email = trim($_POST['useremail']);
        }
        

        if (!empty($_POST['role'])){
            $user_role = trim($_POST['role']);
        }
        


        
        if ($user_email!="" && $user_role!="") {

            $email_array = explode("@", $user_email);
            $domein = $email_array[1];
        
            if($domein =="global17.com" || $domein =="hhm.ch"){

                $roleTitle = trim($user_role);
                $idRole = "";
                
    
          
                foreach($roles as $role){
                    if ($roleTitle == $role->RoleTitle){
                        $idRole = $role->idRole;
                        break;
                    }
                        
                }


                $sql = "INSERT INTO `users` VALUES (DEFAULT, :userEmail, '', :idRole)";

                if ($query = $pdo->prepare($sql)) {
                    $query->bindParam(":userEmail", $user_email, PDO::PARAM_STR);
                    $query->bindParam(":idRole", $idRole, PDO::PARAM_INT);
                    $query->execute();
                    //$res = mail($user_email, "Passwort einstellung", "Um ein Passwort im HHM festzulegen, folgen Sie dem Link <a href='http://localhost:3000/HR/register'>Passwort einstellung</a>");
                //var_dump($res);
                }

                
            }
            else{
                
                $useremail_err = "Ungültiger Domainname!";
            }

        }
        $this->view->roles = $roles;
        $this->view->useremail_err = $useremail_err;
        $this->view->role_err = $role_err;
        $this->view->generate('adduser_view.php', 'auth_view.php');
    }

  
}
