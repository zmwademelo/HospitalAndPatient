<?php
session_start(); 
$myconn = new mysqli('127.0.0.1', 'root', 'zm960902', 'project1') or die(mysqli_error($myconn));

$val = $_POST['select'];
//echo $val;
if($val == 'patient'){

if (isset($_POST['submit'])){
    $pfname = mysqli_real_escape_string($myconn, $_POST['fname']);
    $plname = mysqli_real_escape_string($myconn, $_POST['lname']);  
//echo $plname;
    $result = mysqli_query($myconn, "SELECT * FROM patient WHERE pfname = '".$pfname."' and plname = '".$plname."';") or die(mysqli_error($myconn));
    $row = mysqli_fetch_array($result);
    //if($row['ufname'] == $ufname && $row['ulname'] == $ulname){
    if(!empty($pfname) && !empty($plname) && !strcasecmp($row['pfname'], $pfname) && !strcasecmp($row['plname'], $plname)){//不区分大小写
    //echo "sueccess";
        setcookie('cookie1',$pfname);       //every time comes in the new input, cookie changes.
        setcookie('cookie2',$plname);
        $_SESSION['message'] = "Login success!";
        $_SESSION['msg_type'] = "success";     
        header("location: display.php");}
    else{
    $_SESSION['message'] = "Login failure!";
    $_SESSION['msg_type'] = "danger";
    header("location: error.php");
        }   
    }
}
elseif($val == 'user'){
if (isset($_POST['submit'])){
$ufname = mysqli_real_escape_string($myconn, $_POST['fname']);
$ulname = mysqli_real_escape_string($myconn, $_POST['lname']);
$result = mysqli_query($myconn, "SELECT * FROM users WHERE ufname = '".$ufname."' and ulname = '".$ulname."';") or die(mysqli_error($myconn));
$row = mysqli_fetch_array($result);
    //if($row['ufname'] == $ufname && $row['ulname'] == $ulname){
if(!empty($ufname) && !empty($ulname) && !strcasecmp($row['ufname'], $ufname) && !strcasecmp($row['ulname'], $ulname)){//不区分大小写
    setcookie('cookie1',$ufname);
    setcookie('cookie2',$ulname);
    $_SESSION['message'] = "Login success!";
    $_SESSION['msg_type'] = "success";     
    header("location: index.php");
}else{      
    $_SESSION['message'] = "Login failure!";
    $_SESSION['msg_type'] = "danger";
    header("location: error.php");
    }  
    }
}