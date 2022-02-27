<?php include_once 'loginprocess.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Treatment for patients</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <?php
            $fname = $_COOKIE['cookie1'];   //load potential input from former step
            $lname = $_COOKIE['cookie2'];
            //echo $plname;
            $mysqli = new mysqli('127.0.0.1','root','zm960902','project1') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT distinct C.pfname, C.plname, A.tname, A.ttype, B.tstatus FROM treatment A JOIN patient_treatment  B ON A.tid = B.tid JOIN patient C on B.pid = C.pid WHERE C.pfname = '".$fname."' and C.plname = '".$lname."';") or die($mysqli->error);
            ?>
  <div class="row justify-content-center">
  <h2>Treatment details</h2>
</div>
  <p> <?php echo "Here is the treatment information for " .ucfirst(strtolower($fname)) ." " .ucfirst(strtolower(($lname))).":"; ?></p>     
   <div class="row justify-content-center">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>first name</th>
                            <th>last name</th>
                            <th>treatment name</th>
                            <th>treatment type</th>
                            <th>treatment status</th>
                        </tr>
                    </thead>
            <?php
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['pfname']; ?></td>
                      <td><?php echo $row['plname']; ?></td>
                      <td><?php echo $row['tname']; ?></td>
                      <td><?php echo $row['ttype']; ?></td>
                      <td><?php echo $row['tstatus']; ?></td>
                    </tr>
                <?php endwhile; ?>    
                </table>
            </div>
    <a href="login.php" class="btn btn-warning" role="button">back</a>
</div>

</body>
</html>