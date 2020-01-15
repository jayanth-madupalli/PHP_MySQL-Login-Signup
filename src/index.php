<?php 
include('header.php'); 
if(!$is_online){
    header("Location:login.php");
    exit();
}

?>
<div class="container" style="width:80%;margin:auto;">
    <div class="row justify-content-center" style="margin:50px 0px 20px 0px">
        <h3>Welcome, <?php echo $udata['name'] ?>!</h3>
    </div>
</div>
<?php include('footer.php') ?>