<?php
include("../config/database.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('.././PHPMailer-master/src/Exception.php');
require('.././PHPMailer-master/src/PHPMailer.php');
require('.././PHPMailer-master/src/SMTP.php');

function sendOtp($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vsmsonline0511@gmail.com';
        $mail->Password = 'urfnjbxzvdfibvgr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('vsmsonline0511@gmail.com', 'VSMS');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Recovery Password';
        $mail->Body = "OTP: <b>$otp</b>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_otp'])) {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("SELECT email FROM user_mast WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['otp'] = rand(1000, 9999);

            if (sendOtp($email, $_SESSION['otp'])) {
                $_SESSION['otp_sent'] = "OTP has been sent to your email.";
            } else {
                $error = "Failed to send OTP.";
            }
        } else {
            $_SESSION['error'] = "Email not found in our records. Please try again.";
            header('Location: otp.php');
            exit;
        }
        $stmt->close();
    } else {
        $error = "Invalid email address. Please try again.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $enteredOtp = $_POST['otp'];

    if ($enteredOtp == $_SESSION['otp']) {
        unset($_SESSION['otp']); 
        header('Location: change_password.php');
        exit;
    } else {
        $error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <style>
        body {
    font-family: Arial, sans-serif;
    background: url('img/login_bg5.png') no-repeat center center/cover;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative;
}

.otp-modal {
    background-color: rgba(255, 253, 253, 0.77);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    text-align: center;
    z-index: 1001;
}

.otp-heading {
    font-size: 1.8rem;
    margin-bottom: 20px;
    font-weight: bold;
    color: #e63946;
}

.otp-subheading {
    font-size: 1rem;
    color: #333;
    margin-bottom: 20px;
}

.otp-input-container {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
}

.otp-input {
    background-color: #f1f1f1;
    width: 30px;
    height: 30px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: bold;
    outline: none;
}

.otp-email {
    width: 350px;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-bottom: 20px;
}

.otp-button {
    width: 325px;
    padding: 12px;
    background-color: #e63946;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1.2rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.otp-button:hover {
    background-color: #d62839;
}

.otp-resend {
    margin-top: 15px;
    font-size: 0.9rem;
    color: #e63946;
    text-decoration: none;
    cursor: pointer;
}

.otp-resend:hover {
    text-decoration: underline;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    width: 300px;
    margin: auto;
}

.modal-button {
    background-color: #e63946;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.modal-button:hover {
    background-color: #d62839;
}

    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="otp-modal">
        
        
        <?php if (!isset($_POST['send_otp'])): ?>
            <h2 class="otp-heading">Enter Email ID</h2>
            <form method="POST">
                <input type="email" name="email" class="otp-email" placeholder="Enter your email" required>
                <button type="submit" name="send_otp" class="otp-button">Send OTP</button>
            </form>
        <?php else: ?>
            <h2 class="otp-heading">Enter OTP</h2>
            <p class="otp-subheading">We have sent a verification code to your email: <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>.</p>
            <form method="POST">
                <div class="otp-input-container">
                    <input type="text" maxlength="1" name="otp_digit[]" class="otp-input" required>
                    <input type="text" maxlength="1" name="otp_digit[]" class="otp-input" required>
                    <input type="text" maxlength="1" name="otp_digit[]" class="otp-input" required>
                    <input type="text" maxlength="1" name="otp_digit[]" class="otp-input" required>
                </div>
                <input type="hidden" name="otp" id="otp" value="">
                <button type="submit" name="verify_otp" class="otp-button" onclick="combineOtp()">Verify</button>
            </form>
            <a href="#" class="otp-resend">Resend Code</a>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['otp_sent'])): ?>
            <p class="otp-success" style="color: green;"> <?php echo $_SESSION['otp_sent']; unset($_SESSION['otp_sent']); ?> </p>
        <?php elseif (!empty($error)): ?>
            <p class="otp-error" style="color: red;"> <?php echo $error; ?> </p>
        <?php endif; ?>
    </div>

    <script>
        function combineOtp() {
            const inputs = document.querySelectorAll('.otp-input');
            const otpField = document.getElementById('otp');
            otpField.value = Array.from(inputs).map(input => input.value).join('');
        }
    </script>
</body>
</html>
