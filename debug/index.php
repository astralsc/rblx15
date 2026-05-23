<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php';
  if(!isset($_SESSION['user'])){
	header("Location: /games/");
}else{
extract($_SESSION['userData']);
}
// hello, meditation here. i'm too lazy and sick to fix this shit code. if someone here see this, replace it. thanks.
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'rblx15');
/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<?php pageBuilder::buildHeader(); ?>
<main class="pt-5 container"> 
        <br>    <br>
        <!-- <a href="#" class="btn btn-primary me-md-1 disabled">Login</a>
        <a href="#" class="btn btn-secondary disabled">Register</a> -->
	<div class="card card-body render-main-card">
                <div class="d-flex align-items-center">
            
            <div class="mt-2">
                <h1>
                    Hello, <?php echo(''.htmlspecialchars($_SESSION["user"]["username"]).'');  ?>!
                </h1>
                
                
                
                    <h2>Debug mode is coming soon! (hopefully)</h2>
                
            </div>
        </div>
	<div class="col">
<br>
                        <div class="card card-body">
                            <h5> nothing to do here. </h5>
                            
                        </div>
                    </div>
            </div>    <center>
   


    
<br>
<br>
<br>

<br>
    <br><br><br><br><br><br><br><br><br><br>
<center><br>
</center></main>