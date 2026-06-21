<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylereg.css">
    <style>
    body {
    background: url('img/login_bg5.png') no-repeat center center/cover;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.form_regi {
    display: flex;
    flex-direction: column;
    height: auto;
    width: 450px;
    align-items: center;
    margin: auto;
    margin-top: 5%;
    background-color:rgba(255, 253, 253, 0.77);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
    border-radius: 15px;
    padding: 30px 20px;
}

.form_regi h1 {
    color: #ff3b3f;
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 20px;
}

.box {
    padding: 12px;
    margin: 10px 0;
    width: 90%;
    border: 1px solid #ddd;
    border-radius: 25px;
    background-color: #f9f9f9;
    color: #333;
    font-size: 1rem;
    box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.1);
    transition: border 0.3s, box-shadow 0.3s;
}

.box:focus {
    outline: none;
    border-color: #ff3b3f;
    box-shadow: 0px 0px 5px rgba(255, 59, 63, 0.5);
}

#submit {
    padding: 12px 20px;
    margin-top: 20px;
    width: 90%;
    background-color: #ff3b3f;
    color: #fff;
    border: none;
    outline: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s;
}

#submit:hover {
    background-color: #e22c2f;
    transform: translateY(-3px);
}

.error {
    color: #ff3b3f;
    font-size: 0.8rem;
    font-weight: bold;
    text-align: left;
    width: 90%;
    margin: -8px 0 10px;
}

.d {
    margin-top: 10px;
    text-align: center;
}

.a {
    text-decoration: none;
    color: #ff3b3f;
    font-weight: bold;
    transition: color 0.3s ease;
}

.a:hover {
    color: #e22c2f;
}


    </style>
</head>
<body>
<?php
    include("config/database.php");
    $fullnameErr=$phnoErr=$emailErr= $passErr=$securityque1Err=$securityque2Err="";
    $fullname =filter_input(INPUT_POST,"fullname",FILTER_SANITIZE_SPECIAL_CHARS);
    $phno =filter_input(INPUT_POST,"phno",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST,"pass",FILTER_SANITIZE_SPECIAL_CHARS);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fullname"]) || empty($_POST["phno"]) || empty($_POST["email"]) || empty($_POST["pass"])) {
            if(empty($_POST["fullname"]))
                $fullnameErr = "FullName is required.."; 
            else
                $fullnameErr="";
            if(empty($_POST["phno"]))
                $phnoErr = "Phone Number is required.."; 
            else
                $phnoErr="";
            if(empty($_POST["email"]))
                $emailErr = "Email is required.."; 
            else
                $emailErr="";
            if(empty($_POST["pass"]))
                $passErr = "Password is required..";
            else {
                $passErr="";
            }
            
        }
    }
?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" class="form_regi" method="POST">
        <h1>REGISTER</h1>
        <input type="text" name="fullname" class="box" placeholder="FullName" value="<?php echo htmlspecialchars($fullname);?>">
        <span class="error"><?php echo $fullnameErr;?></span>

        <input type="text" name="phno" class="box" placeholder="Phone Number" value="<?php echo htmlspecialchars($phno);?>">
        <span class="error"><?php echo $phnoErr;?></span>

        <input type="email" name="email" class="box" placeholder="name@mail.com" value="<?php echo htmlspecialchars($email);?>">
        <span class="error"><?php echo $emailErr;?></span>

        <input type="password" name="pass" class="box" placeholder="Password"value="<?php echo htmlspecialchars($pass);?>">
        <span class="error"><?php echo $passErr;?></span>

        <input type="submit" value="REGISTER" id="submit"><br>
        <div class="d">
                <a href="user/otp.php" class="a">Forgot password?</a>
        </div>
        <div class="d">
            <p>Already have an account?
            <a href="login.php" class="a">Sign in</a></p>
        </div>

        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $fullname =filter_input(INPUT_POST,"fullname",FILTER_SANITIZE_SPECIAL_CHARS);
            $phno =filter_input(INPUT_POST,"phno",FILTER_SANITIZE_SPECIAL_CHARS);
            $email =filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
            $pass =filter_input(INPUT_POST,"pass",FILTER_SANITIZE_SPECIAL_CHARS);
            $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
            

            if(empty($fullname) || empty($phno) ||empty($email) ||empty($pass)){
                echo "";
            }
            else{
                $sql="INSERT INTO user_mast(fullname, phno, email, pass) VALUES ('$fullname','$phno', '$email', '$pass_hash')";
                try{
                    mysqli_query($conn,$sql);
                    $user_id = mysqli_insert_id($conn); 
                    $_SESSION['user_id']=$user_id;
                    $_SESSION['username']=$fullname;
                    header("Location:index.php");
                }catch(mysqli_sql_exception){
                    echo'<p style="color: red;  font-weight: bold; font-size: 20px; margin-top:-8%"><br>Registration Unsuccessfull..!</p>';
                }
            } 
        }
        mysqli_close($conn);
        ?>
   </form>
</body>
</html>