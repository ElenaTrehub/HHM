<?php

class Controller_Register extends Controller
{
    public function action_index()
    {
        require_once "config.php";

        $username_err = "";
        $password_err = "";
        $confirm_password_err = "";

        $user = "";
        $password = "";
        $confirm_password = "";


        if (!empty($_POST['username'])) {
            $user = trim($_POST['username']);
        }
        if (!empty($_POST['password'])) {
            $password = trim($_POST['password']);
        }
        if (!empty($_POST['password-confirm'])) {
            $password_confirm = trim($_POST['password-confirm']);
        }
        if(strripos($user, "@") == false){
            //$username_err = "Um sich zu registrieren, geben Sie die Mail ein!";
        }
        else{

            $email_array = explode("@", $user);
            $domein = $email_array[1];
        
            if($domein =="global17.com" || $domein =="hhm.ch"){

                if ($password !== $password_confirm){
                    $password_err = "Passwörter stimmen nicht überein!";
                    $confirm_password_err = "Passwörter stimmen nicht überein!";
                }
                if ($password == ""){
                    $password_err = "Passwort eingeben!";
                }
                if ($password_confirm == ""){
                    $confirm_password_err = "Bestätigen Sie das Passwort!";
                }
                else{
                    $password= password_hash($password, PASSWORD_DEFAULT);
                }
                if (!empty($password)){
                    $sql = "UPDATE `users` SET password = :userPassword WHERE username = :userName";
    
                    if ($query = $pdo->prepare($sql)) {
                        $query->bindParam(":userName", $user, PDO::PARAM_STR);
                        $query->bindParam(":userPassword", $password, PDO::PARAM_STR);
                        $query->execute();
                        header('location: /HR/login');
                    }
                }
                
            }
            else{
                
                //$username_err = "Ungültiger Domainname!";
                
            }  

        }

         
       
        $this->view->username_err = $username_err;
        $this->view->password_err = $password_err;
        $this->view->confirm_password_err = $confirm_password_err;
        $this->view->generate('register_view.php', 'auth_view.php');
    }

    public function check_user()
    {
        $user_name = $_POST['user_name'];
        $email_id  = $_POST['email_id'];
        $count     = $this->model->check_user($user_name, $email_id);
       
        if ($count > 0) {
            echo 'This User Already Exists';
        } else {
            $data = array(
                'id'        => null,
                'user_name' => $_POST['user_name'],
                'email_id'  => $_POST['email_id'],
                'password'  => $_POST['password'],
            );
            $this->model->insert_user($data);
        }
        //header('location: /HR/register');
    }
}
