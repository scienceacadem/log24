<?php
    $emmsg_firstname = $emmsg_lastname = $emmsg_email = $emmsg_phone = $emmsg_password = $emmsg_passwordagain = '';

    $_hostname = 'localhost';
    $_username = 'root';
    $_password = '';
    $_dbname = 'login';

    $conn = mysqli_connect($_hostname, $_username, $_password, $_dbname);

    if(!$conn){
        die ('Connection failed: ' . mysqli_connect_error());
    }

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $newpassword = $_POST['newpassword'];
        $passwordagain = $_POST['passwordagain'];

        $md5_newpassword = md5($newpassword); // Using MD5 for demonstration, but not recommended for passwords

        if(empty($firstname)){
            $emmsg_firstname = 'Fill Up This Field.';
        }
        if(empty($lastname)){
            $emmsg_lastname = 'Fill Up This Field.';
        }
        if(empty($email)){
            $emmsg_email = 'Fill Up This Field.';
        }
        if(empty($phone)){
            $emmsg_phone = 'Fill Up This Field.';
        }
        if(empty($newpassword)){
            $emmsg_password = 'Fill Up This Field.';
        }
        if(empty($passwordagain)){
            $emmsg_passwordagain = 'Fill Up This Field.';
        }

        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($phone) && !empty($newpassword) && !empty($passwordagain)){
            if($newpassword === $passwordagain){

                // Hashing the password
                $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (firstname, lastname, email, phone,newpassword) 
                        VALUES ('$firstname', '$lastname', '$email', '$phone', '$md5_newpassword')";
                
                if(mysqli_query($conn, $sql)){
                    header('location: login.php?usercreated');
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4">
            </div>
                <div class="col-4 border border-light bg-light" style="margin-top:150px;" >
                <form action="regis.php" method="POST">
                    <div>
                         <input type="text" name="firstname" class="form-control"  id="disabledTextInput"
                         placeholder="First Name" value="<?php if(isset ($_POST['submit'])){echo $firstname;}?>" >
                         <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$emmsg_firstname."</span>";}else{
                                echo $emmsg_firstname ;}?> <br>
                         <input type="text" name="lastname" class="form-control"  id="disabledTextInput"
                         placeholder="last Name" value="<?php if(isset ($_POST['submit'])){echo $lastname;}?>"> <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$emmsg_lastname."</span>";}else{
                                echo $emmsg_lastname ;}?><br>
                         <input type="email" name="email" class="form-control"  id="disabledTextInput"
                         placeholder="Email" value="<?php if(isset ($_POST['submit'])){echo $email;}?>"> <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$emmsg_email."</span>";}else{
                                echo $emmsg_email ;}?><br>
                         <input type="tel" id="phone" class="form-control"name="phone" placeholder="Phone Number" 
                         value="<?php if(isset ($_POST['submit'])){echo $phone ;}?>"><?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$emmsg_phone."</span>";}else{
                                echo $emmsg_phone ;}?><br>
                         <input type="password" name="newpassword" class="form-control" 
                         placeholder="New Password">
                         <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$emmsg_password."</span>";}else{
                                echo $emmsg_password ;}?> <br>
                         <input type="password" name="passwordagain" class="form-control" id="disabledTextInput" 
                         placeholder="Password Again" >
                         <?php if(isset($_POST['submit'])){
                            echo "<span class='text-danger'>".$emmsg_passwordagain."</span>";}else{
                                echo $emmsg_passwordagain ;}?>
                         </div><br><br>
                            <input type="submit" name="submit" value="submit" class="btn btn-dark text-white"><br><br>
                         </form>
                         <div> 
                         <label>Have an account?</label>
                         <a href="login.php">login</a>
                    </div>
                </div>
            <div class="col-">
            </div>
        </div>
    </div>
</body>
</html>