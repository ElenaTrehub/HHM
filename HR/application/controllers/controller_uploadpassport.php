<?php
session_start();
class Controller_UploadPassport extends Controller
{
    public function action_index()
    {
        $user_passport = "images/default-passport.jpg";
        
        $target_dir = "documentPhoto/passport/";
        $upload_err = "";
        if (isset($_POST["id"])){
            $idEmployee = $_POST["id"];
            echo ($idEmployee);
        }

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
            $this->view->user_passport = "images/default-passport.jpg";
            $this->view->passport_upload_err = $upload_err;

            if(isset($_SESSION['employeePhotoSrc'])){
                $this->view->user_photo = $_SESSION['employeePhotoSrc'];
                $this->view->upload_err = '';
            }
            else{
                $this->view->user_photo = "image/user.png";
                $this->view->upload_err = '';
            }
            
        } else {
            if (move_uploaded_file($_FILES["passportToUpload"]["tmp_name"], $target_file)) {
                //header("location: /create");
                
                $user_passport = "documentPhoto/passport/" . ($_FILES["passportToUpload"]["name"]);
            } else {
                $upload_err = "Sorry, there was an error uploading your file.";
                $user_passport = "images/default-passport.jpg";
            }
        }

        $_SESSION['employeePassportSrc'] = "documentPhoto/passport/" . ($_FILES["passportToUpload"]["name"]);

        if (isset($idEmployee)) {

            $_SESSION['employeePassport'] = $idEmployee;
            echo( $_SESSION['employeePassportSrc']);
            header("location: /HR/edit");
        } else {
            $this->view->user_passport_name = "documentPhoto/passport/" . ($_FILES["passportToUpload"]["name"]);
            $this->view->user_passport = "images/passport.jpg";
            $this->view->passport_upload_err = $upload_err;


            if(isset($_SESSION['employeePhotoSrc'])){
                $this->view->user_photo = $_SESSION['employeePhotoSrc'];
                $this->view->upload_err = '';
            }
            else{
                $this->view->user_photo = "image/user.png";
                $this->view->upload_err = '';
            }
           $this->view->generate('edit_view.php', 'template_view.php');
        } 
    }
}
