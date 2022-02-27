<?php include_once 'loginprocess.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    
  <title>WDC Hospital</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    body

    {
    background:url(city.jpg)  no-repeat center center;
    background-size:cover;
    background-attachment:fixed;
    background-color:#CCCCCC;
    }
</style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
    <h2 class="text-primary">WDC Hospital Login</h2>
    </div>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
            echo $_SESSION['message']; 
            unset($_SESSION['message']);
        ?>
        </div>
    <?php endif ?>

  <p class="text-warning">Please input your name:</p>
  <form action="login.php" method = "POST">

    <div class="form-group">
      <label for="usr">First name:</label>
      <input type="text" class="form-control"  name="fname" placeholder="Please input first name">
    </div>

    <div class="form-group">
      <label for="pwd">Last name:</label>
      <input type="text" class="form-control"  name="lname" placeholder="please input last name">
    </div>

<div class="form-group">
  <label for="sel1">I am a:</label>
  <select class="form-control" id="sel1" name = "select">
    <option>patient</option>
    <option>user</option>
  </select>
</div>
    

<div class="row justify-content-center">
<button type="submit" class="btn btn-primary" name = "submit" >Login</button>
</div>

  </form>
</div>

</body>
</html>
