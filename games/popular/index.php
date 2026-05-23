<?php

  //$query = mysqli_query($con,"SELECT * FROM games ORDER by gameId");
if (strpos($_SERVER["HTTP_USER_AGENT"], "ROBLOX Android App") == true){
	  header("Location: /games/list");
  }
  include_once $_SERVER['DOCUMENT_ROOT'].'/config/main.php';
  
  // not cleaning up this shitty code until meditext allows someone to rewrite the php :P
  
  
  $FindGames = $pdo->prepare("SELECT * FROM games ORDER by gameId");
  $FindGames->execute();
  # Now for the part of the code that checks if code is set.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);

$code = isset($_REQUEST['code']) ? $_REQUEST['code'] : '';

define('OAUTH2_CLIENT_ID', '1211334550710521958');
define('OAUTH2_CLIENT_SECRET', 'e7g8VilcsWuQINSTPN2W9zyR9Hu6b_u7');

$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$redirectURL = 'https://localhost/test_project/disocrd_responce.php';
$discord_me = "https://discordapp.com/api/users/@me";


if(isset($_GET['code'])){
	// i'm not using anymore this shit.
	/*echo('smth. DONT TAKE A SCREENSHOT!, we are using echo script.
	test: '.$_GET['code']);
	exit();*/
	// this code works 80% fine. just most of my workers think that they can handle this.
	// do not mess this code: meditation
	$discord_code = $_GET['code'];
	
	$payload = [
	'code'=>$discord_code,
	'client_id'=>'1211334550710521958',
	'client_secret'=>'e7g8VilcsWuQINSTPN2W9zyR9Hu6b_u7',
	'grant_type'=>'authorization_code',
	'redirect_uri'=>'https://rb15.us.to/games/',
	'scope'=>'identify%20guids',
	];
	$payload_string = http_build_query($payload);
	$discord_token_url = "https://discordapp.com/api/oauth2/token";
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $discord_token_url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
	$result = curl_exec($ch);
	$result = json_decode($result,true);
	if(isset($result['error'])){
		exit("invalid code, try again.");
	}
	$access_token = $result['access_token'];
	
	$discord_users_url = "https://discordapp.com/api/users/@me";
	$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_URL, $discord_users_url);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
	$result = curl_exec($ch);
	if(!$result){
		exit("invalid code, try again.");
	}
	$result = json_decode($result,true);
	$_SESSION["logged_in"] = true;
	
	$_SESSION['userData'] = [
	'name'=>$result['global_name'],
	'discord_id'=>$result['id'],
	'avatar'=>$result['avatar'],
	];
  header("Location: /games");
}
pageBuilder::buildHeader();
?>


                <div>
<noscript><div class="alert alert-warning"><div class="text-center">Please enable Javascript to use all the features on this site.</div></div></noscript>
                          
                </div>
                                

<style>
 /* add some kewl game stuff */
  .bar
  {
    background: #dc3545;
    height: 10px;
    width: 179px;
    display: block;
    border-radius: 5px;
	
  }
  
  .inner-bar
  {
    background: #198754;
    display: block;
    border-radius: 5px;
    height: 100%;
	margin-bottom: -100px;
  }
  
  .game-item-image
  {
    width: 180px;
    height: 100px;
  }
  
  .game-item
  {
    color: white;
  }
</style>

<div class="main container" style="width:1000px">
    <div class="games-lit">
      <div class="d-md-flex align-items-center w-100">
<div class="d-flex align-items-center">

</div>
<form method="get" class="ms-md-auto me-md-4" style="min-width: 300px;">
</div>
</form>
<h1 class="text-center">Games</h1>
        <div class="row">
<small class="text-center"><p><a class="link-primary" href="/games">Usermade Games</a></p></small>
<small class="text-center"><p><a class="link-secondary" href="/games/popular">Popular</a></p></small>
          </div>
</div>
      <div class="card">
  <div class="card-body">
    <div class="row">

            <?php
while($row = $FindGames->fetch(PDO::FETCH_ASSOC)){
          echo '
  <div class="col-sm-3 mb-3 mb-sm-0">
            <a class="game-item-anchor" rel="external" href="/Place.aspx?id='.$row['gameId'].'" style="text-decoration: none; color: black;">
                  <div class="card">
      <div class="card-body">
            <div class="game-item">
    <div class="always-shown">
        
            <span class=""><img class="game-item-image" src="/images/Unnaproved.png"/></span>
            <div class="game-name notranslate text-truncate text-center">
                '.$row['gameName'].'  
            </div>
            <div class="game-creator notranslate text-truncate text-center">
                By: '.$row['owner'].'
            </div>
                           <div class="game-creator notranslate text-truncate text-center">
                Client: '.$row['client'].'
            </div>
        <div class="hover-shown" id="hoverShown">
             <div class="game-likes notranslate text-truncate text-center">
                <span class="bar"> <span class="inner-bar" style="width: 100%"> </span> </span>
                <i class="fa-solid fa-thumbs-up"></i> 100% \ 0 <i class="fa-solid fa-thumbs-down"></i>
            </div>
        </div>
        </div>
     
    </div></div></a>      <div class="card-footer">
        <small class="text-body-secondary">User-Made Game</small>
      </div>
</div></div>';
}
?>
      </div>
  </div>
</div>
    </div>


 
</div>
</body>
</html>
<?php pageBuilder::buildFooter();?>