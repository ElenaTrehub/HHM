<?php
session_start();
class Controller_Create extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $user_photo="images/user.png";   
        $user_passport = "images/default-passport.jpg";
        $user_passport_name = "";

        unset($_SESSION['employeePassportSrc']);
        unset($_SESSION['employeePhotoSrc']);

        if (isset($_POST['Name'])) {
            $Name = $_POST['Name'];
            
            $LastName = $_POST["LastName"];
            $Photo = $_POST["Photo"];

            $BirthDate = $_POST["BirthDate"];
            $CivilState = $_POST["CivilState"];
            $Address = $_POST["Address"];
            $PLZ = $_POST["PLZ"];
            $Place = $_POST["Place"];
            $Phone = $_POST["Phone"];

            $Pass_Name = $_POST["Pass_Name"];
            $Pass_LastName = $_POST["Pass_LastName"];
            $Pass_Number = $_POST["Pass_Number"];
            $Pass_Expired = $_POST["Pass_Expired"];
            $Pass_Photo = $_POST["Pass_Photo"];

            $CareerStart = $_POST["CareerStart"];
            $Comment = $_POST["Comment"];
            $Position = $_POST["Position"];
            $Salary = $_POST["Salary"];
            $Status=$_POST["Status"];

            $G17_email = $_POST["G17_email"];
            $G17_initials = $_POST["G17_initials"];

            $HHM_email = $_POST["HHM_email"];
            $HHM_initials = $_POST["HHM_initials"];

            $ChildName1 = $_POST["ChildName1"];
            $ChildLastName1 = $_POST["ChildLastName1"];
            $ChildBirthday1 = $_POST["ChildBirthday1"];

            $ChildName2 = $_POST["ChildName2"];
            $ChildLastName2 = $_POST["ChildLastName2"];
            $ChildBirthday2 = $_POST["ChildBirthday2"];

            $ChildName3 = $_POST["ChildName3"];
            $ChildLastName3 = $_POST["ChildLastName3"];
            $ChildBirthday3 = $_POST["ChildBirthday3"];

            $Visit = $_POST["visit"];
            
            $id = 0;
            $sql_GetLastId = "SELECT id FROM Employee ORDER BY id DESC LIMIT 1";
            $querySelect = $pdo->prepare($sql_GetLastId);

            if ($querySelect->execute()) {
                $row = $querySelect->fetch();
                //echo ($row['id']);
                //echo intval($row['id']) + 1;
                $id = intval($row['id']) + 1;
            }
            
            $VisitArray = array_chunk($Visit, 6);
            /* echo("<pre>");
            print_r (array_chunk($Visit, 6));
            echo("</pre>"); */
            
            for ($i=0; $i < count($VisitArray); $i++) { 
                /* echo("<pre>");
                print_r($VisitArray[$i]);                
                echo("</pre>"); */

                //$sqlVisit = "INSERT INTO DB_NAME.`SwissVisit` (`idEmployee`, `StartDate`, `EndDate`, `Location`, `Accommodation`, `Goal`, `Group`) VALUES (:idVisit, :StartDate, :EndDate, :Location, :Accommodation, :Goal, :Group);";
                $queryVisit = $pdo->prepare("INSERT INTO `SwissVisit` VALUES (DEFAULT, :idVisit, :StartDate, :EndDate, :Location, :Accommodation, :Goal, :Group)");

                $queryVisit->bindParam(":idVisit", $id, PDO::PARAM_STR);            
                $queryVisit->bindParam(":StartDate",        $VisitArray[$i][0], PDO::PARAM_STR);
                $queryVisit->bindParam(":EndDate",          $VisitArray[$i][1], PDO::PARAM_STR);
                $queryVisit->bindParam(":Location",         $VisitArray[$i][2], PDO::PARAM_STR);
                $queryVisit->bindParam(":Accommodation",    $VisitArray[$i][3], PDO::PARAM_STR);
                $queryVisit->bindParam(":Goal",             $VisitArray[$i][4], PDO::PARAM_STR);
                $queryVisit->bindParam(":Group",            $VisitArray[$i][5], PDO::PARAM_STR);

                $queryVisit->execute();    
            }
            
            try {
                $pdo->beginTransaction();
             
                $sql = $pdo->prepare("INSERT INTO `Employee` VALUES( :id, :Name , :LastName , :Photo)");
                $sql->bindParam(":id", $id, PDO::PARAM_STR);
                $sql->bindParam(":Name", $Name, PDO::PARAM_STR);
                $sql->bindParam(":LastName", $LastName, PDO::PARAM_STR);
                $sql->bindParam(":Photo", $Photo, PDO::PARAM_STR);
                $sql->execute();
                
                
                
                $PersonalData = $pdo->prepare("INSERT INTO `PersonalData` VALUES( DEFAULT, :idEmployeePersonal , :BirthDate, :CivilState, :Address, :PLZ, :Place, :Phone)");
                $PersonalData->bindParam(":idEmployeePersonal", $id, PDO::PARAM_STR);
                $PersonalData->bindParam(":BirthDate", $BirthDate, PDO::PARAM_STR);
                $PersonalData->bindParam(":CivilState", $CivilState, PDO::PARAM_STR);
                $PersonalData->bindParam(":Address", $Address, PDO::PARAM_STR);
			    $PersonalData->bindParam(":PLZ", $PLZ, PDO::PARAM_STR);
			    $PersonalData->bindParam(":Place", $Place, PDO::PARAM_STR);
                $PersonalData->bindParam(":Phone", $Phone, PDO::PARAM_STR);	
                $PersonalData->execute();
                
                $Career = $pdo->prepare("INSERT INTO `Career` VALUES( DEFAULT, :idEmployee, :Position, :CareerStart, :Comment,  :Salary, :Status, 20)");
                $Career->bindParam(":idEmployee", $id, PDO::PARAM_STR);
                $Career->bindParam(":Comment", $Comment, PDO::PARAM_STR);
                $Career->bindParam(":Position", $Position, PDO::PARAM_STR);
                $Career->bindParam(":CareerStart", $CareerStart, PDO::PARAM_STR);
                $Career->bindParam(":Salary", $Salary, PDO::PARAM_STR);
                $Career->bindParam(":Status", $Status, PDO::PARAM_STR);
                $Career->execute();
                
                $ForeignPassport = $pdo->prepare("INSERT INTO `ForeignPassport` VALUES( DEFAULT  , :idPass, :Pass_Name, :Pass_LastName, :Pass_Number, :Pass_Expired, :Pass_Photo)");
                $ForeignPassport->bindParam(":idPass", $id, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_Name", $Pass_Name, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_LastName", $Pass_LastName, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_Number", $Pass_Number, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_Expired", $Pass_Expired, PDO::PARAM_STR);    
                $ForeignPassport->bindParam(":Pass_Photo", $Pass_Photo, PDO::PARAM_STR);
                $ForeignPassport->execute();


                $G17 = $pdo->prepare("INSERT INTO `G17` VALUES( DEFAULT, :G17_email, :G17_initials, :idG17)");
                $G17->bindParam(":idG17", $id, PDO::PARAM_STR);
                $G17->bindParam(":G17_email", $G17_email, PDO::PARAM_STR);
                $G17->bindParam(":G17_initials", $G17_initials, PDO::PARAM_STR);
                $G17->execute();

                $HHM = $pdo->prepare("INSERT INTO `HHM` VALUES( DEFAULT, :HHM_email, :HHM_initials, :idHHM)");
                $HHM->bindParam(":idHHM", $id, PDO::PARAM_STR);
                $HHM->bindParam(":HHM_email", $HHM_email, PDO::PARAM_STR);
                $HHM->bindParam(":HHM_initials", $HHM_initials, PDO::PARAM_STR);
                $HHM->execute();


                $Children = $pdo->prepare("INSERT INTO `Children` VALUES( DEFAULT, :idParent1, :ChildName1, :ChildLastName1, :ChildBirthday1)");
                $Children->bindParam(":idParent1", $id, PDO::PARAM_STR);
                $Children->bindParam(":ChildName1", $ChildName1, PDO::PARAM_STR);
                $Children->bindParam(":ChildLastName1", $ChildLastName1, PDO::PARAM_STR);
                $Children->bindParam(":ChildBirthday1", $ChildBirthday1, PDO::PARAM_STR);
                $Children->execute();

                $Children = $pdo->prepare("INSERT INTO `Children` VALUES( DEFAULT, :idParent2, :ChildName2, :ChildLastName2, :ChildBirthday2)");
                $Children->bindParam(":idParent2", $id, PDO::PARAM_STR);
			    $Children->bindParam(":ChildName2", $ChildName2, PDO::PARAM_STR);
                $Children->bindParam(":ChildLastName2", $ChildLastName2, PDO::PARAM_STR);
                $Children->bindParam(":ChildBirthday2", $ChildBirthday2, PDO::PARAM_STR);
                $Children->execute();

                $Children = $pdo->prepare("INSERT INTO `Children` VALUES( DEFAULT, :idParent3, :ChildName3, :ChildLastName3, :ChildBirthday3)");
                $Children->bindParam(":idParent3", $id, PDO::PARAM_STR);
			    $Children->bindParam(":ChildName3", $ChildName3, PDO::PARAM_STR);
                $Children->bindParam(":ChildLastName3", $ChildLastName3, PDO::PARAM_STR);
                $Children->bindParam(":ChildBirthday3", $ChildBirthday3, PDO::PARAM_STR);
                $Children->execute();

                $isCommit = $pdo->commit();
                
                if($isCommit){
                    header('location: /HR/main');
                }
                
            } catch (Exception $e) {
                $pdo->rollback();
            }


            /* $sql = "START TRANSACTION;

			INSERT INTO `hhmeweme_hrDev`.`Employee` (`id`, `Name`, `LastName`, `Photo`) VALUES (:id, :Name, :LastName, :Photo);

			INSERT INTO `hhmeweme_hrDev`.`PersonalData` (`idEmployee`, `BirthDate`, `CivilState`, `Address`, `PLZ`, `Place`, `Phone`) 
			VALUES(:idEmployeePersonal, :BirthDate, :CivilState, :Address, :PLZ, :Place, :Phone);

			INSERT INTO `hhmeweme_hrDev`.`Career` (`idEmployee`, `Position`, `Comment`, `CareerStart`, `Salary`, `Status`) VALUES (:idEmployee, :Position, :Comment, :CareerStart, :Salary, :Status);

			INSERT INTO `hhmeweme_hrDev`.`ForeignPassport` (`idEmployee`, `PassName`, `PassLastName`, `Number`, `Valid`) VALUES (:idPass, :Pass_Name, :Pass_LastName, :Pass_Number, :Pass_Expired);

			INSERT INTO `hhmeweme_hrDev`.`G17` (`idEmployee`,`G17_E-Mail`, `G17_initials`) VALUES (:idG17, :G17_email, :G17_initials);

            INSERT INTO `hhmeweme_hrDev`.`HHM` (`idEmployee`,`HHM_E-Mail`, `HHM_Initials`) VALUES (:idHHM, :HHM_email, :HHM_initials);
            
            INSERT INTO `hhmeweme_hrDev`.`Children` (`idEmployee`, `ChildName`, `ChildLastName`, `Birth`) VALUES (:idParent1, :ChildName1, :ChildLastName1, :ChildBirthday1);

            INSERT INTO `hhmeweme_hrDev`.`Children` (`idEmployee`, `ChildName`, `ChildLastName`, `Birth`) VALUES (:idParent2, :ChildName2, :ChildLastName2, :ChildBirthday2);

            INSERT INTO `hhmeweme_hrDev`.`Children` (`idEmployee`, `ChildName`, `ChildLastName`, `Birth`) VALUES (:idParent3, :ChildName3, :ChildLastName3, :ChildBirthday3);

            COMMIT";
            
            //            INSERT INTO `hhmeweme_hrDev`.`SwissVisit` (`idEmployee`, `StartDate`, `EndDate`, `Location`, `Accommodation`, `Goal`, `Group`) VALUES (:idVisit, :StartDate, :EndDate, :Location, :Accommodation, :Goal, :Group); */


            
            /*
            $query->bindParam(":idVisit", $id, PDO::PARAM_STR);            
            $query->bindParam(":StartDate", $VisitStart, PDO::PARAM_STR);
            $query->bindParam(":EndDate", $VisitEnd, PDO::PARAM_STR);
            $query->bindParam(":Location", $VisitLocation, PDO::PARAM_STR);
            $query->bindParam(":Accommodation", $VisitAccommodation, PDO::PARAM_STR);
            $query->bindParam(":Goal", $VisitGoal, PDO::PARAM_STR);
            $query->bindParam(":Group", $VisitGroup, PDO::PARAM_STR);*/

            //echo("<pre>");print_r($_POST);echo("<pre>");

            
            
        }

 
        $this->view->user_photo = $user_photo;
        $this->view->user_passport = $user_passport;
        $this->view->user_passport_name = $user_passport_name;
        $this->view->upload_err = "";
        $this->view->passport_upload_err ="";
        $this->view->generate('create_view.php', 'template_view.php');
        
    }
}