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
        $useremail_answer = "";
        $role_answer = "";


        $roles = array();
        $role = new Role_Model($pdo);
        $roles = $role->GetAllRoles();

        if (!empty($_POST['useremail'])){
            $user_email = trim($_POST['useremail']);
        }
        

        if (!empty($_POST['role'])){
            $user_role = trim($_POST['role']);
        }
        

        if (isset($_POST['action'])) {

            if ($user_email!="" && $user_role!="") {

                if(stristr($user_email, "@")!==false){
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
                            //$query->execute();
                            
                            if($query->execute()){
                                $url = 'https://api.sendgrid.com/';
                                $user = 'azure_d9198d48cbf2ecd468221cd386388861@azure.com';
                                $pass = '220182Sema';
                        
                                $params = array(
                                    'api_user' => $user,
                                    'api_key' => $pass,
                                    'to' => $user_email,
                                    'subject' => 'Passwort vergabe',
                                    'html' => '<html>
                                                <head></head>
                                                    <body>
                                                        <p>Passwort vergabe<br>
                                                        Um ein Passwort zu vergeben,<br> folgen Sie dem Link<br>
                                                        </p>
                                                        <a href="https://hr-tool.azurewebsites.net/HR/register">Passwort vergabe</a>
                                                    </body>
                                            </html>',
                                    'text' => 'Passwort vergabe',
                                    'from' => 'admin.hr-tool.azurewebsites.net/HR',
                                );
                    
                                $request = $url.'api/mail.send.json';
                    
                                // Generate curl request
                                $session = curl_init($request);
                    
                                // Tell curl to use HTTP POST
                                curl_setopt ($session, CURLOPT_POST, true);
                    
                                // Tell curl that this is the body of the POST
                                curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
                    
                                // Tell curl not to return headers, but do return the response
                                curl_setopt($session, CURLOPT_HEADER, false);
                                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
                    
                                // obtain response
                                $response = curl_exec($session);
                                curl_close($session);
                    
                                // print everything out
                                //print_r($response);

                                header('Location: /HR/main');

                            }
        
                            
                        }
        
                        
                    }
                    else{
                        
                        $useremail_err = "Ungültiger Domainname!";
        
                        $this->view->roles = $roles;
                        $this->view->useremail_err = $useremail_err;
                        $this->view->role_err = "";
                        $this->view->useremail_answer = "";
                        $this->view->role_answer = "";
                        $this->view->generate('adduser_view.php', 'auth_view.php');
                    }




                }
                else{

                    $useremail_err = "Benutzer-E-Mail eingeben müssen!";
        
                    $this->view->roles = $roles;
                    $this->view->useremail_err = $useremail_err;
                    $this->view->role_err = "";
                    $this->view->useremail_answer = "";
                    $this->view->role_answer = "";
                    $this->view->generate('adduser_view.php', 'auth_view.php');

                }
                
            }
            else{
    
                if ($user_email==""){
                    $useremail_err = "E-Mail-Feld darf nicht leer sein";
                }
    
                if ($user_role==""){
                    $useremail_err = "Benutzer rollen feld darf nicht leer sein";
                }
    
                $this->view->roles = $roles;
                $this->view->useremail_err = $useremail_err;
                $this->view->role_err = $role_err;
                $this->view->useremail_answer = "";
                $this->view->role_answer = "";
                $this->view->generate('adduser_view.php', 'auth_view.php');
            }


        }
        else{
            $useremail_answer = "Geben Sie die Benutzer-E-Mail-Adresse ein";
            $role_answer = "Geben Sie die Benutzerrolle an";
            $this->view->roles = $roles;
            $this->view->useremail_err = $useremail_err;
            $this->view->role_err = $role_err;
            $this->view->useremail_answer = $useremail_answer;
            $this->view->role_answer = $role_answer;
            $this->view->generate('adduser_view.php', 'auth_view.php');


        }
        
        
    }

  
}
