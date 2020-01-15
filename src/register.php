<?php
include('header.php');
if($is_online){
    header("Location:index.php");
    exit();
}

$msg = "";
if(isset($_POST['reg'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $pass1 = $_POST['pass1'];

    $sql = mysqli_query($conn, "SELECT `id` FROM `users` WHERE `email` = '".$email."' ") or die (mysqli_error($conn));
    if(mysqli_num_rows($sql) > 0)
        $msg = "<div class='alert alert-danger text-center'>Email already registered, Please try again.</div>";
    else if($pass != $pass1)
        $msg = "<div class='alert alert-danger text-center'>Passwords do not match, Please try again.</div>";
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) //cloudflare cdn detection
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        $salt = rand(1000000, 99999999);
        $pass = md5($salt.sha1($pass));      
        mysqli_query($conn, "INSERT INTO users(`name`,`email`,`password`,`reg_ip`,`salt`) VALUES('".$name."', '".$email."', '".$pass."', '".$ip."', '".$salt."') ") or die (mysqli_error($conn));
        $msg = "<div class='alert alert-success text-center'>Registered Successfully, You can login now.</div>";
    }

}

?>
<div class="container" style="width:80%;margin:auto;">
    <div class="row justify-content-center" style="margin:50px 0px 20px 0px">
        <h3>Register</h3>
    </div>
    <?php echo $msg ?>
    <div class="row justify-content-center" style="margin:20px 0px 20px 0px">
        <form class="text-center" action="register.php" method="post">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Your Name" name="name" required/>
                <input class="form-control" type="email" placeholder="Your Email" name="email" required/>
                <input class="form-control" type="password" placeholder="Your Password" name="pass" required/>
                <input class="form-control" type="password" placeholder="Re-enter Password" name="pass1" required/>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" name="reg" type="submit">Register</button>
            </div>
        </form>
    </div>



</div>

<?php include('footer.php') ?>