<?php 
include('header.php'); 
if(!$is_online){
    header("Location:login.php");
    exit();
}

$msg = "";

if(isset($_POST['cpass'])){
    $currpass = mysqli_real_escape_string($conn, $_POST['pass']);
    $currpass = md5($udata['salt'].sha1($currpass));
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);

    if($currpass != $udata['password']){
        $msg = "<div class='alert alert-danger text-center'>Invalid Current Password, Please try again.</div>";
    }else if($pass1 != $pass2){
        $msg = "<div class='alert alert-danger text-center'>New Passwords do not match, Please try again.</div>";
    }else{
        $salt = rand(1000000, 99999999);
        $pass1 = md5($salt.sha1($pass1));  
        mysqli_query($conn, "UPDATE `users` SET `password`='".$pass1."', `salt`='".$salt."'  WHERE `id`='".$udata['id']."' ");
        $msg = "<div class='alert alert-success text-center'>Password Changed Successfully.</div>";
    }
}



?>
<div class="container" style="width:80%;margin:auto;">
    <div class="row justify-content-center" style="margin:50px 0px 20px 0px">
        <h3>Welcome, <?php echo $udata['name'] ?>!</h3>
    </div>
    <?php echo $msg ?>
    <div class="row justify-content-center" style="border: 1px solid #555;padding:20px;text-align:center;border-radius:5px;">
        <form action="index.php" method="post" style="width:70%;margin:auto;">
            <span style="font-size:21px;">Change Password</span>
            <div class="form-group" style="margin-top:15px;">
                <input class="form-control" type="password" name="pass" placeholder="Enter Current Password" required/>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="pass1" placeholder="Enter New Password" required/>
                <input class="form-control" type="password" name="pass2" placeholder="Re-Enter New Password" required/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="cpass" />
            </div>
        </form>
    </div>
</div>
<?php include('footer.php') ?>