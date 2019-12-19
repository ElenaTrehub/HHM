<?php
include $_SERVER['DOCUMENT_ROOT'].'/HR/Twilio/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;

include "application/models/Employee.php";

class Controller_Birthday extends Controller
{
    public function action_index()
    {
        require_once "config.php";
        $sql = "SELECT * FROM Employee             
        LEFT JOIN PersonalData      ON Employee.id = PersonalData.idEmployee"; 

        $empArray = array();


        if ($query = $pdo->prepare($sql)) {
            if ($query->execute()) {
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                
                    $employee = new Employee;
                    $employee->Id = $row['id'];
                    $employee->Name = $row['Name'];
                    $employee->LastName = $row['LastName'];
                    $employee->BirthDate = $row['BirthDate'];         
                    $empArray[] = $employee;
                }
            }
        }
        



        $today_day = date("d");
        $today_month = date("m");

        $birth_emp = array();

        foreach($empArray as $emp){
            $birth_day = (explode("-", $emp->BirthDate))[2];
                $birth_month = (explode("-", $emp->BirthDate))[1];

                if($birth_day == $today_day && $birth_month == $today_month){
                    $birth_emp[] = $emp;
                }
            }
            $birth_string = "";
            if(isset($birth_emp[0])){
                foreach($birth_emp as $birth){
                    $birth_string = $birth_string . " " . $birth->Name . " " . $birth->LastName . ";";
                }
                $account_sid = 'AC482c5a6a8403b82345ad633fdebf05bb';
                $auth_token = '6f749f62408d31c700da8ed84f45d23c';

                // In production, these should be environment variables. E.g.:
                //$auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
                // A Twilio number you own with SMS capabilities

                $twilio_number = "+19525294410";
                $client = new Client($account_sid, $auth_token);
                $client->messages->create(

                    // Where to send a text message (your cell phone?)
                    '+380669646440"',
                    array(
                        'from' => $twilio_number,
                        'body' => 'They are birthday today:' . " " .  $birth_string

                    )
                ); 
        }


    }

}