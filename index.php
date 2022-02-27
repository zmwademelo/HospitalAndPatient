<?php require_once 'process.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>user's database</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row justify-content-around">
        <a href="login.php" class="btn btn-warning" role="button">back</a>
        </div>
        <div class="row justify-content-center">
        <h2 class="text-danger">Treatment - Data Management</h2>
    </div>
        <div class="row justify-content-center">
        <?php
        $fname = $_COOKIE['cookie1'];
        $lname = $_COOKIE['cookie2'];
        echo "Welcome back, " .ucfirst(strtolower($fname)) ." " .ucfirst(strtolower(($lname)))."!";
        ?>
        </div>
        
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php //output messages, banners
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
                </div>
            <?php endif ?>
    <div class="container">
        <?php
            $mysqli = new mysqli('127.0.0.1','root','zm960902','project1') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM treatment A JOIN disease B ON A.deid = B.deid") or die($mysqli->error);

    function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}
$row = $result->fetch_assoc();
array2csv($row);

        ?>
            <div class="row justify-content-center">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>treatment name</th>
                            <th>treatment type</th>
                            <th>disease name</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
            <?php
                while ($row = $result->fetch_assoc()): 
            ?>
                    <tr>
                        <td><?php echo $row['tname']; ?></td>
                        <td><?php echo $row['ttype']; ?></td>
                        <td><?php echo $row['dename']; ?></td>

                        <td>
                            <a href="index.php?edit=<?php echo $row['tid']; ?>"
                               class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['tid']; ?>"
                               class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>    
                </table>
            </div>

        <div class="row justify-content-center">
        <a href="download.php" class="btn btn-success" role="button">download csv</a>
        </div>
        
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
        <input type="hidden" name="tid" value="<?php echo $tid; ?>">  

            <div class="form-group">
            <label>treatment name</label>
            <input type="text" name="tname" class="form-control" 
            value="<?php echo $tname; ?>"  placeholder="Enter treatment name">
            </div>

            <div class="form-group">
             <label>treatment type</label>
            <input type="text" name="ttype" class="form-control" 
            value="<?php echo $ttype; ?>" placeholder="Enter treatment type">
            </div>

            <div class="form-group">
            <label>disease ID</label>
            <input type="text" name="deid" class="form-control" 
            value="<?php echo $deid; ?>" placeholder="Enter disease id">
            </div>

            <div class="form-group">
            <?php 
            if ($update == true): 
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>

        </form>
        </div>
    </div>  




    </body>