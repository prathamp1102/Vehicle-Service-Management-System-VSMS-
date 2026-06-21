<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
       body {
    background: url('img/login_bg5.png') no-repeat center center/cover;
    margin: 0;
    font-family: Arial, sans-serif;
}

.form {
    display: flex;
    flex-direction: column;
    height: auto;
    width: 450px;
    align-items: center;
    margin: auto;
    margin-top: 5%;
    background-color: rgba(255, 253, 253, 0.77);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
    border-radius: 15px;
    padding: 30px 20px;
}

.form h1 {
    color: #ff3b3f;
    font-size: 1.8rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    border-bottom: 3px solid rgba(255, 59, 63, 0.3);
    padding-bottom: 10px;
}

.box {
    padding: 12px;
    margin: 15px 0;
    width: 85%;
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
    margin-top: 30px;
    width: 85%;
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

::placeholder {
    color: #bbb;
    opacity: 0.8;
}

.error {
    color: #ff3b3f;
    font-size: 0.9rem;
    font-weight: bold;
    text-align: left;
    width: 85%;
    margin: -8px 0 10px;
}

    </style>
</head>
<body>
<?php
    include("config/database.php");
    $emailErr= $passErr = "";
    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
    $pass= filter_input(INPUT_POST,"pass",FILTER_SANITIZE_SPECIAL_CHARS);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="POST">
        <h1>LOGIN</h1>
        <input type="email" name="email" class="box" placeholder="name@mail.com" value="<?php echo htmlspecialchars($email);?>">
        <span class="error"><?php echo $emailErr;?></span>

        <input type="password" name="pass" class="box" placeholder="Password" value="<?php echo htmlspecialchars($password);?>">
        <span class="error"><?php echo $passErr;?></span>

        <input type="submit" value="LOGIN" id="submit"><br>
        <div class="d">
                <a href="user/otp.php" class="a">Forgot password?</a>
            </div>
            <div class="d">
                <p>Don't have an account?
                <a href="registration.php" class="a">Sign up</a></p>
            </div>
        <?php
        include("config/database.php");
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"pass",FILTER_SANITIZE_SPECIAL_CHARS);

            if(empty($email)){
                echo "";
            }
            elseif(empty($password)){
                echo "";
            }
            
            else{
                $sql = "SELECT * FROM admin_mast WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    if ($password === $user["pass"]) {
                        $_SESSION['admin_id'] = $user['admin_id'];
                        $_SESSION['admin_name'] = $user['name'];
                        $_SESSION['email']=$email;
                        header("Location:admin/admin_index.php");
                        exit;
                    } 
                }

                $sql = "SELECT * FROM user_mast WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                    if (password_verify($password, $user["pass"])) {
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['email']=$email;
                        $_SESSION['username'] = $user['fullname'];
                        header("Location:index.php");
                        exit;
                    } else {
                        echo '<p style="color: red; font-weight: bold; font-size: 20px"><br>Incorrect password.</p>';
                    }
                } else {
                    echo '<p style="color: red; font-weight: bold; font-size: 20px"><br>Invalid email.</p>';
                }
            }
        }
        mysqli_close($conn);
        ?>
    </form>
</body>
</html>