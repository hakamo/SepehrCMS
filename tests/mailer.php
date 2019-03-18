<?php


$name ="";
$email = "";
$education = "";
$skils = "";
$birthdate = "";
$telephone = "";
$comment = "";



if(isset($_POST["name"]))
    $name = $_POST["name"];

if(isset($_POST["email"]))
    $email = $_POST["email"];


if(isset($_POST["education"]))
    $education = $_POST["education"];

if(isset($_POST["skils"]))
    $skils = $_POST["skils"];

if(isset($_POST["birthdate"]))
    $birthdate = $_POST["birthdate"];

if(isset($_POST["telephone"]))
    $telephone = $_POST["telephone"];

if(isset($_POST["comment"]))
    $comment = $_POST["comment"];




// the message
//$msg = "First line of text\nSecond line of text";

$msg = "یک کاربر چدید ثبت نام کرده است:"."\n";

$msg  .= "نام و نام خانوادگی"+"\n" ;
$msg  .= $name +"\n" ;

$msg .= "پست الکترونیک"."\n";
$msg .= $email +"\n" ;
     
$msg .= "تحصیلات"."\n";
$msg .= $education +"\n" ;
     
$msg .= "مهارت های شخصی"."\n";
$msg .= $skils +"\n" ;
     
$msg .= "تاریخ تولد"."\n";
$msg .= $birthdate +"\n" ;
     
$msg .= "تلفن"."\n";
$msg .= $telephone +"\n" ;
     
$msg .= "نام و نام خانوادگی"."\n";
$msg .= $comment +"\n" ;



// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("unsecurezone@yahoo.com","ثبت نام جدید",$msg);

?>


