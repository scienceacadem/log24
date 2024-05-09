<?php
    $regissucces = 'Registration Succesful';

    $eampty_userid = $eampty_password = '';
    $_hostname = 'localhost';
    $_username = 'root';
    $_password = '';
    $_dbname = 'login';

    $conn = mysqli_connect($_hostname, $_username, $_password, $_dbname);

    if(!$conn){
        die ('Connection failed: ' . mysqli_connect_error());
    }

    if (isset($_POST['submit'])){
        $userid = $_POST['userid'];
        $password =  $_POST['password'];
        
        $md5_password = md5($password);
    
        if (empty($userid)){
            $eampty_userid = 'Fill this field';
        }
        if (empty($password)){
            $eampty_password = 'Fill this field';
        }
        if(!empty($userid) && !empty($password)){
            $sql = "SELECT * FROM users WHERE email = '$userid' AND newpassword = '$md5_password'";
            $query = $conn->query($sql);
    
            if($query->num_rows > 0){
                echo "found";
            }else{
                echo "not found";
              echo $sql;
            }
        }  
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
    Science Academy
        <div class="row align-items-center">
            <div class="col-4">
            </div>
                <div class="col-4 border border-light bg-light" style="margin-top:150px;" >
                
                <?php
                    if (isset($_GET['usercreated'])){
                        echo "<span class='text-success'>".$regissucces."</span>";
                    }
                ?>
                <form action="login.php" method="POST">
                    <div>
                      <label class="form-label"> User Id: </label> <br>
                        <input type="text" name="userid" class="form-control"  id="disabledTextInput" placeholder="Email or Phone number"><?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$eampty_userid."</span>";}else{
                                echo $eampty_userid ;}?> <br>
                        <label class="form-label">  Password : </label> <br>
                        <input type="password" name="password" class="form-control">
                        <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$eampty_password."</span>";}else{
                                echo $eampty_password ;}?>
                    </div><br><br>
                    <input type="submit" name="submit" value="submit" class="btn btn-dark text-white"><br><br>
                    </form>
                    <div> 
                        <label>Have not an account?</label>
                        <a href="regis.php">Creat new account</a>
                    </div>
                </div>
            <div class="col-">
            </div>
        </div>
    </div>
</body>
</html>