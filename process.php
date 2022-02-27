<?php
session_start(); 
$mysqli = new mysqli('127.0.0.1', 'root', 'zm960902', 'project1') or die(mysqli_error($mysqli));

$tid = 0;
$update = false;
$tname = '';
$ttype = '';
$deid = '';

if (isset($_POST['save'])){
//Original code without prevention of SQL injection
    /*$tid = $_POST['tid'];
    $tname = $_POST['tname'];
    $ttype = $_POST['ttype'];
    $deid = $_POST['deid'];
    $mysqli->query("INSERT INTO treatment (tid, tname, ttype, deid) VALUES('$tid', '$tname', '$ttype', '$deid')") or
            die($mysqli->error);*/
    $tid = mysqli_real_escape_string($mysqli, $_POST['tid']);
    $tname = mysqli_real_escape_string($mysqli, $_POST['tname']);
    $ttype = mysqli_real_escape_string($mysqli, $_POST['ttype']);
    $deid = mysqli_real_escape_string($mysqli, $_POST['deid']);
    $result = $mysqli->query("SELECT * FROM disease WHERE deid=$deid") or header("location: index.php?input=invalid");
    $row = mysqli_fetch_array($result);

    if(empty($tname) || empty($ttype) || empty($deid) || empty(trim($tname)) || empty(trim($ttype)) || empty(trim($deid))){
        header("location: index.php?input=empty");
        $_SESSION['message'] = "Please fill in all fields!!";
        $_SESSION['msg_type'] = "danger";
            exit();
    }elseif(preg_match('/[\:\;\"\']+/', $tname)){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "Invalid data!";
            $_SESSION['msg_type'] = "danger";
            exit();
    }elseif(preg_match('/[\:\;\"\']+/', $ttype)){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "Invalid data!";
            $_SESSION['msg_type'] = "danger";
            exit();
    }elseif(!preg_match('/^[0-9]+$/', $deid)){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "Invalid data!";
            $_SESSION['msg_type'] = "danger";
            exit();
    }elseif($row['deid'] != $deid){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "No such disease!";
            $_SESSION['msg_type'] = "danger";
            exit();      //防止和disease的主键不匹配
    }else{
        $sql = "INSERT INTO treatment (tid, tname, ttype, deid) VALUES(?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($mysqli);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL error";
        }else{
            mysqli_stmt_bind_param($stmt, "isss", $tid, $tname, $ttype, $deid);
            mysqli_stmt_execute($stmt);
    }
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
    }   
}

if (isset($_GET['delete'])){
//deleting data
    $tid = $_GET['delete'];
    $mysqli->query("DELETE FROM treatment WHERE tid=$tid") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}

if (isset($_GET['edit'])){
    $tid = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM treatment WHERE tid=$tid") or die($mysqli->error());
    //if (count($result)==1){
    if($result->num_rows){
        $row = $result->fetch_array();
        $tname = $row['tname'];
        $ttype = $row['ttype'];
        $deid = $row['deid'];
    }
}

if (isset($_POST['update'])){
//update operation (previous version)
    /*$tid = $_POST['tid'];
    $tname = $_POST['tname'];
    $ttype = $_POST['ttype'];
    $deid = $_POST['deid'];
    $mysqli->query("UPDATE treatment SET  tname='$tname', ttype ='$ttype', deid = '$deid'  WHERE tid=$tid") or
            die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header('location: index.php');*/
    $tid = mysqli_real_escape_string($mysqli, $_POST['tid']);
    $tname = mysqli_real_escape_string($mysqli, $_POST['tname']);
    $ttype = mysqli_real_escape_string($mysqli, $_POST['ttype']);
    $deid = mysqli_real_escape_string($mysqli, $_POST['deid']);
    $result = $mysqli->query("SELECT * FROM disease WHERE deid=$deid") or header("location: index.php?input=invalid");
    $row = mysqli_fetch_array($result);

    if(empty($tname) || empty($ttype) || empty($deid) || empty(trim($tname)) || empty(trim($ttype)) || empty(trim($deid))){
        header("location: index.php?input=empty&tid=$tid&tname=$tname&ttype=$ttype&deid=$deid");//为了让结果再返回首页，避免重新编辑
        $_SESSION['message'] = "Please fill in all fields!!";
        $_SESSION['msg_type'] = "danger";
        exit();
    }elseif(preg_match('/[\:\;\"\']+/', $tname)){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "Invalid data!";
            $_SESSION['msg_type'] = "danger";
            exit();
    }elseif(preg_match('/[\:\;\"\']+/', $ttype)){     //过滤特定符号
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "Invalid data!";
            $_SESSION['msg_type'] = "danger";
            exit();
    }elseif(!preg_match('/^[0-9]+$/', $deid)){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "Invalid data!";
            $_SESSION['msg_type'] = "danger";
            exit();
    }elseif($row['deid'] != $deid){
            header("location: index.php?input=invalid");
            $_SESSION['message'] = "No such disease!";
            $_SESSION['msg_type'] = "danger";
            exit();      //防止和disease的主键不匹配
    }else{
        $sql = "UPDATE treatment SET  tname=?, ttype =?, deid = ?  WHERE tid=$tid";
        $stmt = mysqli_stmt_init($mysqli);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL error";
        }else{
        mysqli_stmt_bind_param($stmt, "sss", $tname, $ttype, $deid);//准备三个column即可
        mysqli_stmt_execute($stmt);

    }
            $_SESSION['message'] = "Record has been updated!";
            $_SESSION['msg_type'] = "warning";
            header("location: index.php");
    }  
}
