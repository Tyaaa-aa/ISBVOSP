<!DOCTYPE html>
<html>
<!-- HEAD CONTENT -->
<?php include "head.php";
if (isset($_SESSION["userid"])) {
    header("Location: index.php");
}
?>

<body>
    <!-- HEADER CONTENT -->
    <?php include "header.php" ?>
    <!-- BODY CONTENT BELOW -->
    <section id="login-container">
        <div class="login_splash">
            <img src="img/login_splash.png" alt="Login splash image" class="login_splash_img">
        </div>
        <div class="login-box">
            <form class="login-form" method="POST" action="login_backend.php">
                <div class="field-box">
                    <h1>Login to TeleNode</h1>
                    <input type="text" placeholder="Username" name="userName" id="userName" class="inputForm" required>
                    <input type="password" placeholder="Password" name="userPassword" id="userPassword" class="inputForm" required>
                    <br>
                    <div>
                        <input type="checkbox" id="showPassword" name="showPassword" value="showPassword" class="showPassword">
                        <label for="showPassword">Show Password</label>
                    </div>

                    <input type="submit" value="Login" class="btn login-btn" id="login_btn">
                    <br>
                    <span>
                        Don't have an account?
                        <a href="#" class="registerForm-btn">
                            <b>Sign up</b>
                        </a>
                    </span>
                </div>
            </form>
        </div>

        <div class="register-box">
            <form class="login-form" method="POST" enctype="multipart/form-data" action="register_backend.php" id="register_form">
                <div class="field-box">
                    <h1>Create an account</h1>
                    <input type="text" placeholder="Username" name="userName_reg" id="userName_reg" class="inputForm" required>
                    <!-- <input type="email" placeholder="E-Mail" name="userEmail_reg" id="userEmail_reg" class="inputForm" required>
                    <input type="password" placeholder="Password" name="userPassword_reg" id="userPassword_reg" class="inputForm" required>
                    <input type="password" placeholder="Confirm Password" name="userPassword_reg" id="userPasswordCnfm_reg" class="inputForm" required> -->
                    <br>
                    <span id="password_msg">Confirm Password Message</span>
                    <input type="submit" value="Register" class="btn login-btn" id="register_btn">
                    <span>Already have an account? <a href="#" class="loginForm-btn"><b>Login</b></a></span>
                </div>
            </form>
        </div>
    </section>

    <!-- FOOTER CONTENT -->
    <?php include "footer.php" ?>
</body>

</html>