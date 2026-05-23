<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php';
  if(!isset($_SESSION['user'])){
	
  }else{
$username = $_SESSION["user"]["username"];
  }
  pageBuilder::buildHeader();
  ?>      
    <style>
    .disabled {
        pointer-events: none;
        opacity: 0.5;
        text-decoration: none;
        cursor: default;
    }
</style>                    
  <main class="pt-5 container"> 
        <br>    <br>
        <!-- <a href="#" class="btn btn-primary me-md-1 disabled">Login</a>
        <a href="#" class="btn btn-secondary disabled">Register</a> -->
	<?php
//please ffs fix this

if(!isset($_SESSION['user'])){	
    /*echo('<div class="card">
  <div class="card-body">
  <div id="liveAlertPlaceholder"></div>
  <center>
    <h1>
      <h1 style="font-size: 50px;">RBLX15 | awesomesauce revival</h1>
    </h1>
    <i>Ready to experience 2015? Login with your discord account to get started!</i><br>
<br> <a href="/login_discord.php" class="btn btn-primary me-md-1">Login with Discord</a>    <center>
');*/


    echo('<div class="card">
  <div class="card-body">
  <div id="liveAlertPlaceholder"></div>
  <center>
    <h1>
      <h1 style="font-size: 50px;">RBLX15 | awesomesauce revival</h1>
    </h1>
    <i>Ready to experience 2015? Login with your discord account to get started!</i><br>
<br> <a href="/login/" class="btn btn-primary me-md-1">Login</a> <a href="/register/" class="btn btn-primary me-md-1">Sign Up</a>');

}else{
	echo('<div class="card card-body render-main-card">
                <div class="d-flex align-items-center">
            <img class="rounded-circle" src="https://devforum-uploads.s3.dualstack.us-east-2.amazonaws.com/uploads/original/4X/d/1/2/d120b245f694af8bb4ebb41c467e7686a168553a.png" style="width:auto;max-height: 130px;">
            <div class="mt-2">
                <h1>
                    Hello, '.htmlspecialchars($username).'!
                </h1>
                
                
                
                    <img src="https://static.wikia.nocookie.net/roblox/images/7/77/TBCIcon.png" class="builders-club" style="width: 60px;">
                
            </div>
        </div>
	<div class="col">
<br>
                        <div class="card card-body">
                            <h5> Friends (1) </h5>
                            <a class="d-inline-block text-decoration-none text-light me-3" style="max-width:100px" href="#">
                        <div class="position-relative">
                            <!--<img src="https://cdn.sitetest1.rb15.us.to/pending.png" width="100" height="100" class="bg-light d-inline-block align-text-top rounded-circle">-->
                            <img src="https://devforum-uploads.s3.dualstack.us-east-2.amazonaws.com/uploads/original/4X/d/1/2/d120b245f694af8bb4ebb41c467e7686a168553a.png" width="100" height="100" class="bg-light d-inline-block align-text-top rounded-circle">
                                                    </div>
                        <p class="mb-0 text-center">ROBLOX</p>
                    </a>
                        </div>
                    </div>
            </div>');
}

?>
    <center>
   
</body>
</html>
    </div></div>
<br>
<br>
<br>

<br>
    <br><br><br><br><br><br><br><br><br><br>
<?php
  pageBuilder::buildFooter();
  ?>