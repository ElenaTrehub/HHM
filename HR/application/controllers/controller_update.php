<?php
include "application/models/Child.php";
include "application/models/City.php";
include "application/models/SwissVisit.php";

class Controller_Update extends Controller
{
    public function action_index()
    {
        session_start();
        require_once "config.php";
        
        $Photo = '';
      
        if (isset($_POST["photo"])){

            $user_photo = "image/user.png";
            $target_dir = "employeePhoto/";
            $upload_err = "";
    
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is a actual image or fake image
            if (isset($_POST["photo"]) && strlen($_FILES["fileToUpload"]["name"]) > 0) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $upload_err = "File is not an image.";
                    $uploadOk = 0;
                }
            }
    
            // Check if file already exists
            if (file_exists($target_file)) {
                $user_photo = "employeePhoto/" . ($_FILES["fileToUpload"]["name"]);
                $upload_err = "Foto already exists.";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                $upload_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
    
            if ($uploadOk == 0) {
                //$upload_err = "Photo already exists.";
    
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //header("location: /create");
    
                    $user_photo = "employeePhoto/" . ($_FILES["fileToUpload"]["name"]);
                } else {
                    $upload_err = "Sorry, there was an error uploading your file.";
                    $user_photo = "images/user.png";
                }
            }


            $Photo = $user_photo;
        }//Photo
        


        if (isset($_POST["passport"])){

            $user_passport = "images/default-passport.jpg";
        
            $target_dir = "documentPhoto/passport/";
            $upload_err = "";
    
            $target_file = $target_dir.basename($_FILES["passportToUpload"]["name"]);
    
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Check if image file is a actual image or fake image
            if (isset($_POST["passport"]) && strlen($_FILES["passportToUpload"]["name"]) > 0) {
                $check = filesize($_FILES["passportToUpload"]["tmp_name"]);
                
                if ($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $upload_err = "File is not an image.";
                    $uploadOk = 0;
                }
            }
    
            // Check if file already exists
             if (file_exists($target_file)) {
                $user_passport = "documentPhoto/passport/" . ($_FILES["passportToUpload"]["name"]);
                $upload_err = "Document already exists.";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if ($imageFileType != "pdf") {
                $upload_err = "Sorry, only PDF files are allowed.";
                $uploadOk = 0;
            }
            
            if ($uploadOk == 0) {
                //$upload_err = "Photo already exists.";
                // if everything is ok, try to upload file
                
            } else {
                if (move_uploaded_file($_FILES["passportToUpload"]["tmp_name"], $target_file)) {
                    //header("location: /create");
                    
                    $user_passport = "documentPhoto/passport/" . ($_FILES["passportToUpload"]["name"]);
                } else {
                    $upload_err = "Sorry, there was an error uploading your file.";
                    $user_passport = "images/default-passport.jpg";
                }
            }
            $Pass_Photo = $user_passport;

        }//Passport


        $cites = array();

        $sqlCity = "SELECT * FROM Cities";
        if($queryCites = $pdo->prepare($sqlCity)){
            if ($queryCites->execute()) {
                while ($rowCity = $queryCites->fetch()) {
                    $city = new City;
                    $city->idCity = $rowCity['idCity'];
                    $city->titleCity = $rowCity['cityTitle'];

                    $cites[] = $city;
                }
            }

        }

       /* echo ("<pre>");
        var_dump($_POST);
        echo ("<pre>"); */



            

        if (isset($_POST['Name'])) {
            $Name = $_POST['Name'];
            $LastName = $_POST["LastName"];
            
            if ($_POST["Photo"] !='' && isset($_POST["photo"]) == false) {

                $Photo = $_POST["Photo"];
            }
            

            $BirthDate = $_POST["BirthDate"];
            $CivilState = $_POST["CivilState"];
            $Address = $_POST["Address"];
            $PLZ = $_POST["PLZ"];

            $PlaceEmploee = $_POST["Place"];


            $Place = trim($PlaceEmploee);
            $idCity = 1;

            if($Place!=""){
                foreach($cites as $city){
                    
                    if($city->titleCity == $PlaceEmploee){
                        $idCity = $city->idCity;
                        break;
                    }
                    
                }
            }
            
/* echo ("<pre>");
            var_dump($_POST);
            
            echo ("<pre>");  */



            
            $Phone = $_POST["Phone"];

            $Pass_Name = $_POST["Pass_Name"];
            $Pass_LastName = $_POST["Pass_LastName"];
            $Pass_Number = $_POST["Pass_Number"];
            $Pass_Expired = $_POST["Pass_Expired"];

            if ($_POST["Pass_Photo"] !='' && isset($_POST["passport"]) == false) {

                $Pass_Photo = $_POST["Pass_Photo"];
            }

            

            $CareerStart = $_POST["CareerStart"];
            $Position = $_POST["Position"];
            $Comment = $_POST["Comment"];
            $Salary = $_POST["Salary"];
            $Status = $_POST["Status"];

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

            
            

            
            //$VisitStart = $_POST["VisitStart"];
            //$VisitEnd = $_POST["VisitEnd"];
            //$VisitLocation = $_POST["VisitLocation"];
            //$VisitAccommodation = $_POST["VisitAccommodation"];
            //$VisitGoal = $_POST["VisitGoal"];
            //$VisitGroup = $_POST["VisitGroup"];
        }

        if(isset($_POST["visit"])){
            $Visit = $_POST["visit"];
        }
        else{
            $Visit = [];
        }

        if($_POST['id'] == "" && isset($_SESSION['employeeID']) == false){
            $id = 0;
            $sql_GetLastId = "SELECT id FROM Employee ORDER BY id DESC LIMIT 1";
            $querySelect = $pdo->prepare($sql_GetLastId);

            if ($querySelect->execute()) {
                $row = $querySelect->fetch();
                //echo ($row['id']);
                //echo intval($row['id']) + 1;
                $id = intval($row['id']) + 1;
                echo ($id);
            }
            
            
            try {
                $pdo->beginTransaction();

                if(count($Visit)>0){
                    $VisitArray = array_chunk($Visit, 6);
            
                    for ($i=0; $i < count($VisitArray); $i++) { 
                        
                        $queryVisit = $pdo->prepare("INSERT INTO `SwissVisit` VALUES (DEFAULT, :idVisit, :StartDate, :EndDate, :Location, :Accommodation, :Goal, :Group)");
        
                        $queryVisit->bindParam(":idVisit", $id, PDO::PARAM_INT);            
                        $queryVisit->bindParam(":StartDate",        $VisitArray[$i][0], PDO::PARAM_STR);
                        $queryVisit->bindParam(":EndDate",          $VisitArray[$i][1], PDO::PARAM_STR);
                        $queryVisit->bindParam(":Location",         $VisitArray[$i][2], PDO::PARAM_STR);
                        $queryVisit->bindParam(":Accommodation",    $VisitArray[$i][3], PDO::PARAM_STR);
                        $queryVisit->bindParam(":Goal",             $VisitArray[$i][4], PDO::PARAM_STR);
                        $queryVisit->bindParam(":Group",            $VisitArray[$i][5], PDO::PARAM_STR);
        
                        $queryVisit->execute();    
                    }
                }
                 
               
                
                $sqlUser = $pdo->prepare("INSERT INTO `Employee` VALUES (:id, :Name, :LastName, :Photo)");
                $sqlUser->bindParam(":id", $id, PDO::PARAM_INT);
                $sqlUser->bindParam(":Name", $Name, PDO::PARAM_STR);
                $sqlUser->bindParam(":LastName", $LastName, PDO::PARAM_STR);
                $sqlUser->bindParam(":Photo", $Photo, PDO::PARAM_STR);
                $sqlUser->execute();
               
                $PersonalData = $pdo->prepare("INSERT INTO `PersonalData` VALUES( DEFAULT, :idEmployeePersonal , :BirthDate, :CivilState, :Address, :PLZ, :Phone, :idCity)");
                $PersonalData->bindParam(":idEmployeePersonal", $id, PDO::PARAM_INT);
                $PersonalData->bindParam(":BirthDate", $BirthDate, PDO::PARAM_STR);
                $PersonalData->bindParam(":CivilState", $CivilState, PDO::PARAM_STR);
                $PersonalData->bindParam(":Address", $Address, PDO::PARAM_STR);
			    $PersonalData->bindParam(":PLZ", $PLZ, PDO::PARAM_STR);
                $PersonalData->bindParam(":Phone", $Phone, PDO::PARAM_STR);
                $PersonalData->bindParam(":idCity", $idCity, PDO::PARAM_INT);	
                $PersonalData->execute(); 
              
               
                $Career = $pdo->prepare("INSERT INTO `Career` VALUES( DEFAULT, :idEmployee, :Position, :CareerStart, :Comment,  :Salary, :Status, 20)");
                $Career->bindParam(":idEmployee", $id, PDO::PARAM_INT);
                $Career->bindParam(":Comment", $Comment, PDO::PARAM_STR);
                $Career->bindParam(":Position", $Position, PDO::PARAM_STR);
                $Career->bindParam(":CareerStart", $CareerStart, PDO::PARAM_STR);
                $Career->bindParam(":Salary", $Salary, PDO::PARAM_STR);
                $Career->bindParam(":Status", $Status, PDO::PARAM_STR);
                $Career->execute();
                
                $ForeignPassport = $pdo->prepare("INSERT INTO `ForeignPassport` VALUES( DEFAULT  , :idPass, :Pass_Name, :Pass_LastName, :Pass_Number, :Pass_Expired, :Pass_Photo)");
                $ForeignPassport->bindParam(":idPass", $id, PDO::PARAM_INT);
                $ForeignPassport->bindParam(":Pass_Name", $Pass_Name, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_LastName", $Pass_LastName, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_Number", $Pass_Number, PDO::PARAM_STR);
                $ForeignPassport->bindParam(":Pass_Expired", $Pass_Expired, PDO::PARAM_STR);    
                $ForeignPassport->bindParam(":Pass_Photo", $Pass_Photo, PDO::PARAM_STR);
                $ForeignPassport->execute();


                $G17 = $pdo->prepare("INSERT INTO `G17` VALUES( DEFAULT, :G17_email, :G17_initials, :idG17)");
                $G17->bindParam(":idG17", $id, PDO::PARAM_INT);
                $G17->bindParam(":G17_email", $G17_email, PDO::PARAM_STR);
                $G17->bindParam(":G17_initials", $G17_initials, PDO::PARAM_STR);
                $G17->execute();

                $HHM = $pdo->prepare("INSERT INTO `HHM` VALUES( DEFAULT, :HHM_email, :HHM_initials, :idHHM)");
                $HHM->bindParam(":idHHM", $id, PDO::PARAM_INT);
                $HHM->bindParam(":HHM_email", $HHM_email, PDO::PARAM_STR);
                $HHM->bindParam(":HHM_initials", $HHM_initials, PDO::PARAM_STR);
                $HHM->execute();


                $Children = $pdo->prepare("INSERT INTO `Children` VALUES( DEFAULT, :idParent1, :ChildName1, :ChildLastName1, :ChildBirthday1)");
                $Children->bindParam(":idParent1", $id, PDO::PARAM_INT);
                $Children->bindParam(":ChildName1", $ChildName1, PDO::PARAM_STR);
                $Children->bindParam(":ChildLastName1", $ChildLastName1, PDO::PARAM_STR);
                $Children->bindParam(":ChildBirthday1", $ChildBirthday1, PDO::PARAM_STR);
                $Children->execute();

                $Children = $pdo->prepare("INSERT INTO `Children` VALUES( DEFAULT, :idParent2, :ChildName2, :ChildLastName2, :ChildBirthday2)");
                $Children->bindParam(":idParent2", $id, PDO::PARAM_INT);
			    $Children->bindParam(":ChildName2", $ChildName2, PDO::PARAM_STR);
                $Children->bindParam(":ChildLastName2", $ChildLastName2, PDO::PARAM_STR);
                $Children->bindParam(":ChildBirthday2", $ChildBirthday2, PDO::PARAM_STR);
                $Children->execute();

                $Children = $pdo->prepare("INSERT INTO `Children` VALUES( DEFAULT, :idParent3, :ChildName3, :ChildLastName3, :ChildBirthday3)");
                $Children->bindParam(":idParent3", $id, PDO::PARAM_INT);
			    $Children->bindParam(":ChildName3", $ChildName3, PDO::PARAM_STR);
                $Children->bindParam(":ChildLastName3", $ChildLastName3, PDO::PARAM_STR);
                $Children->bindParam(":ChildBirthday3", $ChildBirthday3, PDO::PARAM_STR);
                $Children->execute(); 

                $pdo->commit();
                //header('location: /HR/main');
                
                $_SESSION['employeeID'] = $id;
            } 
            catch (Exception $e) {
                $pdo->rollback();
            } 
        }
        else{
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $_SESSION['employeeID'] = $id;
            }
            else{
                $id = $_SESSION['employeeID'];
            }

            

           $childArray = array();

            $sqlChildren = "SELECT * FROM Children WHERE Children.idEmployee = $id";
            if ($queryChildren = $pdo->prepare($sqlChildren)) {
                $queryChildren->bindParam(":id", $id, PDO::PARAM_INT);

                if ($queryChildren->execute()) {
                    while ($rowChild = $queryChildren->fetch()) {
                        $child = new Child;
                        $child->idChild = $rowChild['idChildren'];
                        $child->idParent = $rowChild['idEmployee'];
                        $child->ChildName = $rowChild['ChildName'];
                        $child->ChildLastName = $rowChild['ChildLastName'];
                        $child->ChildBirthday = $rowChild['Birth'];
                        $childArray[] = $child;
                    }
                }
            }

            $visitArray = array();

            $sqlClearVisit = "DELETE FROM SwissVisit WHERE idEmployee = :id";
            if ($queryClearVisit = $pdo->prepare($sqlClearVisit)) {
                $queryClearVisit->bindParam(":id", $id, PDO::PARAM_INT);
                $queryClearVisit->execute();
            }

            $VisitArray = array_chunk($Visit, 6);

            for ($i = 0; $i < count($VisitArray); $i++) {
                echo ("<pre>");
                print_r($VisitArray[$i]);
                echo ("</pre>");

                $sqlVisit = "INSERT INTO `hhmeweme_hrDev`.`SwissVisit` (`idEmployee`, `StartDate`, `EndDate`, `Location`, `Accommodation`, `Goal`, `Group`) VALUES (:idVisit, :StartDate, :EndDate, :LocationR, :Accommodation, :Goal, :Group);";
                $queryVisit = $pdo->prepare($sqlVisit);

                $queryVisit->bindParam(":idVisit", $id, PDO::PARAM_STR);
                $queryVisit->bindParam(":StartDate",        $VisitArray[$i][0], PDO::PARAM_STR);
                $queryVisit->bindParam(":EndDate",          $VisitArray[$i][1], PDO::PARAM_STR);
                $queryVisit->bindParam(":LocationR",        $VisitArray[$i][2], PDO::PARAM_STR);
                $queryVisit->bindParam(":Accommodation",    $VisitArray[$i][3], PDO::PARAM_STR);
                $queryVisit->bindParam(":Goal",             $VisitArray[$i][4], PDO::PARAM_STR);
                $queryVisit->bindParam(":Group",            $VisitArray[$i][5], PDO::PARAM_STR);

                $queryVisit->execute();
            }                 

            $sqlVisit = "SELECT * FROM SwissVisit where SwissVisit.idEmployee = :id";
            if ($queryVisit = $pdo->prepare($sqlVisit)) {
                $queryVisit->bindParam(":id", $id, PDO::PARAM_STR);
                
                if ($queryVisit->execute()) {
                    while ($rowVisit = $queryVisit->fetch()) {
                        $visit = new SwissVisit();
                        $visit->idEmployee = $rowVisit['idEmployee'];
                        $visit->StartDate = $rowVisit['StartDate'];
                        $visit->EndDate = $rowVisit['EndDate'];
                        $visit->Location = $rowVisit['Location'];
                        $visit->Accommodation = $rowVisit['Accommodation'];
                        $visit->Goal = $rowVisit['Goal'];
                        $visit->Group = $rowVisit['Group'];

                        $visitArray[] = $visit;
                    }
                }
            }

            $sql = "START TRANSACTION;
            UPDATE `hhmeweme_hrDev`.`Employee` SET `Name`= :Name, `LastName` = :LastName, `Photo`=:Photo WHERE `id` =:id;
            UPDATE `hhmeweme_hrDev`.`PersonalData` SET `BirthDate`= :BirthDate, `CivilState`=:CivilState , `Address`=:Address , `PLZ`= :PLZ, `idCity` = :idCity, `Phone`= :Phone WHERE `idEmployee` =:id ;
            UPDATE `hhmeweme_hrDev`.`Career` SET `Position`=:Position, `Comment`=:Comment, `CareerStart` = :CareerStart, `Salary` = :Salary, `Status`=:Status WHERE `idEmployee` =:id;
            UPDATE `hhmeweme_hrDev`.`ForeignPassport` SET `PassName`=:Pass_Name, `PassLastName` = :Pass_LastName, `Number`=:Pass_Number, `Valid`=:Pass_Expired, `PhotoPassport`=:Pass_Photo WHERE `idEmployee`=:id;
            UPDATE `hhmeweme_hrDev`.`G17` SET `G17_E-Mail`=:G17_email, `G17_initials`=:G17_initials WHERE `idEmployee`=:id;
            UPDATE `hhmeweme_hrDev`.`HHM` SET `HHM_E-Mail`=:HHM_email,  `HHM_initials`=:HHM_initials WHERE `idEmployee`=:id;
            UPDATE `hhmeweme_hrDev`.`Children` SET `ChildName`=:ChildName1, `ChildLastName`=:ChildLastName1, `Birth`=:ChildBirthday1 WHERE `idEmployee`=:id and `idChildren`=:idChild1;
            UPDATE `hhmeweme_hrDev`.`Children` SET `ChildName`=:ChildName2, `ChildLastName`=:ChildLastName2, `Birth`=:ChildBirthday2 WHERE `idEmployee`=:id and `idChildren`=:idChild2;
            UPDATE `hhmeweme_hrDev`.`Children` SET `ChildName`=:ChildName3, `ChildLastName`=:ChildLastName3, `Birth`=:ChildBirthday3 WHERE `idEmployee`=:id and `idChildren`=:idChild3;
        
            COMMIT;";

            $query = $pdo->prepare($sql);


            echo("PDO PREPARE!!!!!");
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->bindParam(":Name", $Name, PDO::PARAM_STR);
            $query->bindParam(":LastName", $LastName, PDO::PARAM_STR);
            $query->bindParam(":Photo", $Photo, PDO::PARAM_STR);

            //$query->bindParam(":idEmployeePersonal", $id, PDO::PARAM_STR);
            $query->bindParam(":BirthDate", $BirthDate, PDO::PARAM_STR);
            $query->bindParam(":CivilState", $CivilState, PDO::PARAM_STR);
            $query->bindParam(":Address", $Address, PDO::PARAM_STR);
            $query->bindParam(":PLZ", $PLZ, PDO::PARAM_STR);
            $query->bindParam(":idCity", $idCity, PDO::PARAM_INT);
            $query->bindParam(":Phone", $Phone, PDO::PARAM_STR);

            $query->bindParam(":Position", $Position, PDO::PARAM_STR);
            $query->bindParam(":Comment", $Comment, PDO::PARAM_STR);
            $query->bindParam(":CareerStart", $CareerStart, PDO::PARAM_STR);
            $query->bindParam(":Salary", $Salary, PDO::PARAM_STR);
            $query->bindParam(":Status", $Status, PDO::PARAM_STR);

            $query->bindParam(":Pass_Name", $Pass_Name, PDO::PARAM_STR);
            $query->bindParam(":Pass_LastName", $Pass_LastName, PDO::PARAM_STR);
            $query->bindParam(":Pass_Number", $Pass_Number, PDO::PARAM_STR);
            $query->bindParam(":Pass_Expired", $Pass_Expired, PDO::PARAM_STR);
            $query->bindParam(":Pass_Photo", $Pass_Photo, PDO::PARAM_STR);

            $query->bindParam(":G17_email", $G17_email, PDO::PARAM_STR);
            $query->bindParam(":G17_initials", $G17_initials, PDO::PARAM_STR);

            $query->bindParam(":HHM_email", $HHM_email, PDO::PARAM_STR);
            $query->bindParam(":HHM_initials", $HHM_initials, PDO::PARAM_STR);


            $query->bindParam(":ChildName1", $ChildName1, PDO::PARAM_STR);
            $query->bindParam(":ChildLastName1", $ChildLastName1, PDO::PARAM_STR);
            $query->bindParam(":ChildBirthday1", $ChildBirthday1, PDO::PARAM_STR);
            $query->bindParam(":idChild1", $childArray[0]->idChild, PDO::PARAM_STR);

            $query->bindParam(":ChildName2", $ChildName2, PDO::PARAM_STR);
            $query->bindParam(":ChildLastName2", $ChildLastName2, PDO::PARAM_STR);
            $query->bindParam(":ChildBirthday2", $ChildBirthday2, PDO::PARAM_STR);
            $query->bindParam(":idChild2", $childArray[1]->idChild, PDO::PARAM_STR);

            $query->bindParam(":ChildName3", $ChildName3, PDO::PARAM_STR);
            $query->bindParam(":ChildLastName3", $ChildLastName3, PDO::PARAM_STR);
            $query->bindParam(":ChildBirthday3", $ChildBirthday3, PDO::PARAM_STR);
            $query->bindParam(":idChild3", $childArray[2]->idChild, PDO::PARAM_STR);

            $query->bindParam(":idVisit", $id, PDO::PARAM_STR);
            $query->bindParam(":StartDate", $VisitStart, PDO::PARAM_STR);
            $query->bindParam(":EndDate", $VisitEnd, PDO::PARAM_STR);
            $query->bindParam(":Location", $VisitLocation, PDO::PARAM_STR);
            $query->bindParam(":Accommodation", $VisitAccommodation, PDO::PARAM_STR);
            $query->bindParam(":Goal", $VisitGoal, PDO::PARAM_STR);
            $query->bindParam(":Group", $VisitGroup, PDO::PARAM_STR); 
            $query->execute();
          
             /* if ($query->execute()) {
                header('location: /HR/main');
            } else {
                echo ("Error");
            }  */

        }
        if(isset($_POST['SaveButton'])){
            header('location: /HR/main');
            
        }
        else{
            header('location: /HR/edit');
        } 
  



        
    }
}
